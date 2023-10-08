<?php
   
namespace App\Http\Controllers\API;
   
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\User_design_templates_table_Model;
use Validator;
use App\Http\Resources\User_design_templates_table_Resource;
   
class User_design_templates_table_Controller extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $User_design_templates_table_Model=new User_design_templates_table_Model();
        
        $User_design_templates_tables = $User_design_templates_table_Model->index();
    
        return $this->sendResponse(User_design_templates_table_Resource::collection($User_design_templates_tables), 'User_design_templates_tables retrieved successfully.');
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
			 'user_idt' => 'required', 
			 'design_name' => 'required', 
			 'design_url' => 'required', 
			 'images' => 'required', 
			 'oter_settings' => 'required', 
			  
			 
        ]);
    
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
        
        $User_design_templates_table_Model=new User_design_templates_table_Model();
        $rid = $User_design_templates_table_Model->store($input);
        $User_design_templates_table = User_design_templates_table_Model::find($rid);
        return $this->sendResponse(new User_design_templates_table_Resource($User_design_templates_table), 'User_design_templates_table created successfully.');
    } 
   
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $User_design_templates_table_Model=new User_design_templates_table_Model();
        
        $User_design_templates_table = $User_design_templates_table_Model->show($id);
  
        if (is_null($User_design_templates_table)) {
            return $this->sendError('User_design_templates_table not found.');
        }
   
        return $this->sendResponse(new User_design_templates_table_Resource($User_design_templates_table), 'User_design_templates_table retrieved successfully.');
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
        $User_design_templates_table = User_design_templates_table_Model::where("status","!=","D")->find($id);
		if($User_design_templates_table){
			$input = json_decode($request->getContent(),true);
            $validate=array();
                    foreach($input as $key => $value) {
                        //echo "$key: $key\n";
                        // if(array_key_exists("user_id",$input)){
                            // $validate['user_id']="required";
                        // }
						
                        
		 if (array_key_exists('user_idt',$input))
			{
				$validate['user_idt']= "required";
			} 
		 if (array_key_exists('design_name',$input))
			{
				$validate['design_name']= "required";
			} 
		 if (array_key_exists('design_url',$input))
			{
				$validate['design_url']= "required";
			} 
		 if (array_key_exists('images',$input))
			{
				$validate['images']= "required";
			} 
		 if (array_key_exists('oter_settings',$input))
			{
				$validate['oter_settings']= "required";
			} 
		 
                          
                      } 
			$validator = Validator::make($input,$validate); 
	   
			if($validator->fails()){
				return $this->sendError('Validation Error.', $validator->errors());       
			}
			$User_design_templates_table_Model=new User_design_templates_table_Model();
			$User_design_templates_tables = $User_design_templates_table_Model->edit($User_design_templates_table,$input);
			
            $User_design_templates_table = User_design_templates_table_Model::where("status","!=","D")->find($id);
			return $this->sendResponse(new User_design_templates_table_Resource($User_design_templates_table), 'User_design_templates_table updated successfully.');
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
        
        $User_design_templates_table = User_design_templates_table_Model::find($id);
  
        if (is_null($User_design_templates_table)) {
            return $this->sendError('Value not found.');
        }else{
            $User_design_templates_table_Model=new User_design_templates_table_Model();
           $User_design_templates_table_Model->remove($User_design_templates_table);
            return $this->sendResponse([], 'User_design_templates_table deleted successfully.');
        }
       
    }
}