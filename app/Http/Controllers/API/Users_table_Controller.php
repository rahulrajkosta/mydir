<?php
   
namespace App\Http\Controllers\API;
   
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Users_table_Model;
use Validator;
use App\Http\Resources\Users_table_Resource;
   
class Users_table_Controller extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Users_table_Model=new Users_table_Model();
        
        $Users_tables = $Users_table_Model->index();
    
        return $this->sendResponse(Users_table_Resource::collection($Users_tables), 'Users_tables retrieved successfully.');
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
			 'username' => 'required', 
			 'password' => 'required', 
			 'email' => 'required', 
			 'shipping' => 'required', 
			 'billing' => 'required', 
			 'other_info' => 'required', 
			  
			 
        ]);
    
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
        
        $Users_table_Model=new Users_table_Model();
        $rid = $Users_table_Model->store($input);
        $Users_table = Users_table_Model::find($rid);
        return $this->sendResponse(new Users_table_Resource($Users_table), 'Users_table created successfully.');
    } 
   
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $Users_table_Model=new Users_table_Model();
        
        $Users_table = $Users_table_Model->show($id);
  
        if (is_null($Users_table)) {
            return $this->sendError('Users_table not found.');
        }
   
        return $this->sendResponse(new Users_table_Resource($Users_table), 'Users_table retrieved successfully.');
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
        $Users_table = Users_table_Model::where("status","!=","D")->find($id);
		if($Users_table){
			$input = json_decode($request->getContent(),true);
            $validate=array();
                    foreach($input as $key => $value) {
                        //echo "$key: $key\n";
                        // if(array_key_exists("user_id",$input)){
                            // $validate['user_id']="required";
                        // }
						
                        
		 if (array_key_exists('username',$input))
			{
				$validate['username']= "required";
			} 
		 if (array_key_exists('password',$input))
			{
				$validate['password']= "required";
			} 
		 if (array_key_exists('email',$input))
			{
				$validate['email']= "required";
			} 
		 if (array_key_exists('shipping',$input))
			{
				$validate['shipping']= "required";
			} 
		 if (array_key_exists('billing',$input))
			{
				$validate['billing']= "required";
			} 
		 if (array_key_exists('other_info',$input))
			{
				$validate['other_info']= "required";
			} 
		 
                          
                      } 
			$validator = Validator::make($input,$validate); 
	   
			if($validator->fails()){
				return $this->sendError('Validation Error.', $validator->errors());       
			}
			$Users_table_Model=new Users_table_Model();
			$Users_tables = $Users_table_Model->edit($Users_table,$input);
			
            $Users_table = Users_table_Model::where("status","!=","D")->find($id);
			return $this->sendResponse(new Users_table_Resource($Users_table), 'Users_table updated successfully.');
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
        
        $Users_table = Users_table_Model::find($id);
  
        if (is_null($Users_table)) {
            return $this->sendError('Value not found.');
        }else{
            $Users_table_Model=new Users_table_Model();
           $Users_table_Model->remove($Users_table);
            return $this->sendResponse([], 'Users_table deleted successfully.');
        }
       
    }
}