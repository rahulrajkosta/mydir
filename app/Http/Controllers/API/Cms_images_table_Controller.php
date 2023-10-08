<?php
   
namespace App\Http\Controllers\API;
   
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Cms_images_table_Model;
use Validator;
use App\Http\Resources\Cms_images_table_Resource;
   
class Cms_images_table_Controller extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Cms_images_table_Model=new Cms_images_table_Model();
        
        $Cms_images_tables = $Cms_images_table_Model->index();
    
        return $this->sendResponse(Cms_images_table_Resource::collection($Cms_images_tables), 'Cms_images_tables retrieved successfully.');
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
			 'page_id' => 'required', 
			 'image_url' => 'required', 
			 'alt_text' => 'required', 
			  
			 
        ]);
    
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
        
        $Cms_images_table_Model=new Cms_images_table_Model();
        $rid = $Cms_images_table_Model->store($input);
        $Cms_images_table = Cms_images_table_Model::find($rid);
        return $this->sendResponse(new Cms_images_table_Resource($Cms_images_table), 'Cms_images_table created successfully.');
    } 
   
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $Cms_images_table_Model=new Cms_images_table_Model();
        
        $Cms_images_table = $Cms_images_table_Model->show($id);
  
        if (is_null($Cms_images_table)) {
            return $this->sendError('Cms_images_table not found.');
        }
   
        return $this->sendResponse(new Cms_images_table_Resource($Cms_images_table), 'Cms_images_table retrieved successfully.');
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
        $Cms_images_table = Cms_images_table_Model::where("status","!=","D")->find($id);
		if($Cms_images_table){
			$input = json_decode($request->getContent(),true);
            $validate=array();
                    foreach($input as $key => $value) {
                        //echo "$key: $key\n";
                        // if(array_key_exists("user_id",$input)){
                            // $validate['user_id']="required";
                        // }
						
                        
		 if (array_key_exists('page_id',$input))
			{
				$validate['page_id']= "required";
			} 
		 if (array_key_exists('image_url',$input))
			{
				$validate['image_url']= "required";
			} 
		 if (array_key_exists('alt_text',$input))
			{
				$validate['alt_text']= "required";
			} 
		 
                          
                      } 
			$validator = Validator::make($input,$validate); 
	   
			if($validator->fails()){
				return $this->sendError('Validation Error.', $validator->errors());       
			}
			$Cms_images_table_Model=new Cms_images_table_Model();
			$Cms_images_tables = $Cms_images_table_Model->edit($Cms_images_table,$input);
			
            $Cms_images_table = Cms_images_table_Model::where("status","!=","D")->find($id);
			return $this->sendResponse(new Cms_images_table_Resource($Cms_images_table), 'Cms_images_table updated successfully.');
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
        
        $Cms_images_table = Cms_images_table_Model::find($id);
  
        if (is_null($Cms_images_table)) {
            return $this->sendError('Value not found.');
        }else{
            $Cms_images_table_Model=new Cms_images_table_Model();
           $Cms_images_table_Model->remove($Cms_images_table);
            return $this->sendResponse([], 'Cms_images_table deleted successfully.');
        }
       
    }
}