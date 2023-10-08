<?php
   
namespace App\Http\Controllers\API;
   
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Reviews_ratings_table_Model;
use Validator;
use App\Http\Resources\Reviews_ratings_table_Resource;
   
class Reviews_ratings_table_Controller extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Reviews_ratings_table_Model=new Reviews_ratings_table_Model();
        
        $Reviews_ratings_tables = $Reviews_ratings_table_Model->index();
    
        return $this->sendResponse(Reviews_ratings_table_Resource::collection($Reviews_ratings_tables), 'Reviews_ratings_tables retrieved successfully.');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $input = json_decode($request->getContent(),true);
        $validator = Validator::make($input, [
            // 'name' => 'required',
			//'created_at' => 'required', 
			// 'updated_at' => 'required', 
			 'user_id' => 'required', 
			 'product_id' => 'required', 
			 'rating' => 'required', 
			 'review_text' => 'required', 
			 'time_stamp' => 'required', 
			  
			 
        ]);
    
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
        
        $Reviews_ratings_table_Model=new Reviews_ratings_table_Model();
        $rid = $Reviews_ratings_table_Model->store($input);
        $Reviews_ratings_table = Reviews_ratings_table_Model::find($rid);
        return $this->sendResponse(new Reviews_ratings_table_Resource($Reviews_ratings_table), 'Reviews_ratings_table created successfully.');
    } 
   
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $Reviews_ratings_table_Model=new Reviews_ratings_table_Model();
        
        $Reviews_ratings_table = $Reviews_ratings_table_Model->show($id);
  
        if (is_null($Reviews_ratings_table)) {
            return $this->sendError('Reviews_ratings_table not found.');
        }
   
        return $this->sendResponse(new Reviews_ratings_table_Resource($Reviews_ratings_table), 'Reviews_ratings_table retrieved successfully.');
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $Reviews_ratings_table = Reviews_ratings_table_Model::where("status","!=","D")->find($id);
		if($Reviews_ratings_table){
			$input = json_decode($request->getContent(),true);
            $validate=array();
                    foreach($input as $key => $value) {
                        //echo "$key: $key\n";
                        // if(array_key_exists("user_id",$input)){
                            // $validate['user_id']="required";
                        // }
						
                        
		 if (array_key_exists('user_id',$input))
			{
				$validate['user_id']= "required";
			} 
		 if (array_key_exists('product_id',$input))
			{
				$validate['product_id']= "required";
			} 
		 if (array_key_exists('rating',$input))
			{
				$validate['rating']= "required";
			} 
		 if (array_key_exists('review_text',$input))
			{
				$validate['review_text']= "required";
			} 
		 if (array_key_exists('time_stamp',$input))
			{
				$validate['time_stamp']= "required";
			} 
		 
                          
                      } 
			$validator = Validator::make($input,$validate); 
	   
			if($validator->fails()){
				return $this->sendError('Validation Error.', $validator->errors());       
			}
			$Reviews_ratings_table_Model=new Reviews_ratings_table_Model();
			$Reviews_ratings_tables = $Reviews_ratings_table_Model->edit($Reviews_ratings_table,$input);
			
            $Reviews_ratings_table = Reviews_ratings_table_Model::where("status","!=","D")->find($id);
			return $this->sendResponse(new Reviews_ratings_table_Resource($Reviews_ratings_table), 'Reviews_ratings_table updated successfully.');
		}else{
			return $this->sendError('Value not found.');
		}
        
    }
   
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $Reviews_ratings_table = Reviews_ratings_table_Model::find($id);
  
        if (is_null($Reviews_ratings_table)) {
            return $this->sendError('Value not found.');
        }else{
            $Reviews_ratings_table_Model=new Reviews_ratings_table_Model();
           $Reviews_ratings_table_Model->remove($Reviews_ratings_table);
            return $this->sendResponse([], 'Reviews_ratings_table deleted successfully.');
        }
       
    }
}