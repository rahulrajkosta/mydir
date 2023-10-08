<?php
   
namespace App\Http\Controllers\API;
   
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Cms_pages_table_Model;
use Validator;
use App\Http\Resources\Cms_pages_table_Resource;
   
class Cms_pages_table_Controller extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Cms_pages_table_Model=new Cms_pages_table_Model();
        
        $Cms_pages_tables = $Cms_pages_table_Model->index();
    
        return $this->sendResponse(Cms_pages_table_Resource::collection($Cms_pages_tables), 'Cms_pages_tables retrieved successfully.');
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
			 'title' => 'required', 
			 'content' => 'required', 
			 'author' => 'required', 
			 'seo_data' => 'required', 
			  
			 
        ]);
    
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
        
        $Cms_pages_table_Model=new Cms_pages_table_Model();
        $rid = $Cms_pages_table_Model->store($input);
        $Cms_pages_table = Cms_pages_table_Model::find($rid);
        return $this->sendResponse(new Cms_pages_table_Resource($Cms_pages_table), 'Cms_pages_table created successfully.');
    } 
   
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $Cms_pages_table_Model=new Cms_pages_table_Model();
        
        $Cms_pages_table = $Cms_pages_table_Model->show($id);
  
        if (is_null($Cms_pages_table)) {
            return $this->sendError('Cms_pages_table not found.');
        }
   
        return $this->sendResponse(new Cms_pages_table_Resource($Cms_pages_table), 'Cms_pages_table retrieved successfully.');
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
        $Cms_pages_table = Cms_pages_table_Model::where("status","!=","D")->find($id);
		if($Cms_pages_table){
			$input = json_decode($request->getContent(),true);
            $validate=array();
                    foreach($input as $key => $value) {
                        //echo "$key: $key\n";
                        // if(array_key_exists("user_id",$input)){
                            // $validate['user_id']="required";
                        // }
						
                        
		 if (array_key_exists('title',$input))
			{
				$validate['title']= "required";
			} 
		 if (array_key_exists('content',$input))
			{
				$validate['content']= "required";
			} 
		 if (array_key_exists('author',$input))
			{
				$validate['author']= "required";
			} 
		 if (array_key_exists('seo_data',$input))
			{
				$validate['seo_data']= "required";
			} 
		 
                          
                      } 
			$validator = Validator::make($input,$validate); 
	   
			if($validator->fails()){
				return $this->sendError('Validation Error.', $validator->errors());       
			}
			$Cms_pages_table_Model=new Cms_pages_table_Model();
			$Cms_pages_tables = $Cms_pages_table_Model->edit($Cms_pages_table,$input);
			
            $Cms_pages_table = Cms_pages_table_Model::where("status","!=","D")->find($id);
			return $this->sendResponse(new Cms_pages_table_Resource($Cms_pages_table), 'Cms_pages_table updated successfully.');
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
        
        $Cms_pages_table = Cms_pages_table_Model::find($id);
  
        if (is_null($Cms_pages_table)) {
            return $this->sendError('Value not found.');
        }else{
            $Cms_pages_table_Model=new Cms_pages_table_Model();
           $Cms_pages_table_Model->remove($Cms_pages_table);
            return $this->sendResponse([], 'Cms_pages_table deleted successfully.');
        }
       
    }
}