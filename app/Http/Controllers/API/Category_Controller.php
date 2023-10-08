<?php
   
namespace App\Http\Controllers\API;
   
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Category_Model;
use Validator;
use App\Http\Resources\Category_Resource;
   
class Category_Controller extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Category_Model=new Category_Model();
        
        $Categorys = $Category_Model->index();
    
        return $this->sendResponse(Category_Resource::collection($Categorys), 'Categorys retrieved successfully.');
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
			 'ttile' => 'required', 
			 'sub_categ_id' => 'required', 
			 'categ_id' => 'required', 
			  
			 
        ]);
    
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
        
        $Category_Model=new Category_Model();
        $rid = $Category_Model->store($input);
        $Category = Category_Model::find($rid);
        return $this->sendResponse(new Category_Resource($Category), 'Category created successfully.');
    } 
   
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $Category_Model=new Category_Model();
        
        $Category = $Category_Model->show($id);
  
        if (is_null($Category)) {
            return $this->sendError('Category not found.');
        }
   
        return $this->sendResponse(new Category_Resource($Category), 'Category retrieved successfully.');
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
        $Category = Category_Model::where("status","!=","D")->find($id);
		if($Category){
			$input = json_decode($request->getContent(),true);
            $validate=array();
                    foreach($input as $key => $value) {
                        //echo "$key: $key\n";
                        // if(array_key_exists("user_id",$input)){
                            // $validate['user_id']="required";
                        // }
						
                        
		 if (array_key_exists('ttile',$input))
			{
				$validate['ttile']= "required";
			} 
		 if (array_key_exists('sub_categ_id',$input))
			{
				$validate['sub_categ_id']= "required";
			} 
		 if (array_key_exists('categ_id',$input))
			{
				$validate['categ_id']= "required";
			} 
		 
                          
                      } 
			$validator = Validator::make($input,$validate); 
	   
			if($validator->fails()){
				return $this->sendError('Validation Error.', $validator->errors());       
			}
			$Category_Model=new Category_Model();
			$Categorys = $Category_Model->edit($Category,$input);
			
            $Category = Category_Model::where("status","!=","D")->find($id);
			return $this->sendResponse(new Category_Resource($Category), 'Category updated successfully.');
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
        
        $Category = Category_Model::find($id);
  
        if (is_null($Category)) {
            return $this->sendError('Value not found.');
        }else{
            $Category_Model=new Category_Model();
           $Category_Model->remove($Category);
            return $this->sendResponse([], 'Category deleted successfully.');
        }
       
    }
}