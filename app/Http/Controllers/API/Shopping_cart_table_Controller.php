<?php
   
namespace App\Http\Controllers\API;
   
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Shopping_cart_table_Model;
use Validator;
use App\Http\Resources\Shopping_cart_table_Resource;
   
class Shopping_cart_table_Controller extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Shopping_cart_table_Model=new Shopping_cart_table_Model();
        
        $Shopping_cart_tables = $Shopping_cart_table_Model->index();
    
        return $this->sendResponse(Shopping_cart_table_Resource::collection($Shopping_cart_tables), 'Shopping_cart_tables retrieved successfully.');
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
			 'qty' => 'required', 
			  
			 
        ]);
    
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
        
        $Shopping_cart_table_Model=new Shopping_cart_table_Model();
        $rid = $Shopping_cart_table_Model->store($input);
        $Shopping_cart_table = Shopping_cart_table_Model::find($rid);
        return $this->sendResponse(new Shopping_cart_table_Resource($Shopping_cart_table), 'Shopping_cart_table created successfully.');
    } 
   
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $Shopping_cart_table_Model=new Shopping_cart_table_Model();
        
        $Shopping_cart_table = $Shopping_cart_table_Model->show($id);
  
        if (is_null($Shopping_cart_table)) {
            return $this->sendError('Shopping_cart_table not found.');
        }
   
        return $this->sendResponse(new Shopping_cart_table_Resource($Shopping_cart_table), 'Shopping_cart_table retrieved successfully.');
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
        $Shopping_cart_table = Shopping_cart_table_Model::where("status","!=","D")->find($id);
		if($Shopping_cart_table){
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
		 if (array_key_exists('qty',$input))
			{
				$validate['qty']= "required";
			} 
		 
                          
                      } 
			$validator = Validator::make($input,$validate); 
	   
			if($validator->fails()){
				return $this->sendError('Validation Error.', $validator->errors());       
			}
			$Shopping_cart_table_Model=new Shopping_cart_table_Model();
			$Shopping_cart_tables = $Shopping_cart_table_Model->edit($Shopping_cart_table,$input);
			
            $Shopping_cart_table = Shopping_cart_table_Model::where("status","!=","D")->find($id);
			return $this->sendResponse(new Shopping_cart_table_Resource($Shopping_cart_table), 'Shopping_cart_table updated successfully.');
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
        
        $Shopping_cart_table = Shopping_cart_table_Model::find($id);
  
        if (is_null($Shopping_cart_table)) {
            return $this->sendError('Value not found.');
        }else{
            $Shopping_cart_table_Model=new Shopping_cart_table_Model();
           $Shopping_cart_table_Model->remove($Shopping_cart_table);
            return $this->sendResponse([], 'Shopping_cart_table deleted successfully.');
        }
       
    }
}