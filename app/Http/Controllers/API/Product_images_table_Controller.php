<?php
   
namespace App\Http\Controllers\API;
   
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Product_images_table_Model;
use Validator;
use App\Http\Resources\Product_images_table_Resource;
   
class Product_images_table_Controller extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Product_images_table_Model=new Product_images_table_Model();
        
        $Product_images_tables = $Product_images_table_Model->index();
    
        return $this->sendResponse(Product_images_table_Resource::collection($Product_images_tables), 'Product_images_tables retrieved successfully.');
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
			 'product_id' => 'required', 
			 'categ_id' => 'required', 
			 'img_url' => 'required', 
			 'alt_text' => 'required', 
			  
			 
        ]);
    
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
        
        $Product_images_table_Model=new Product_images_table_Model();
        $rid = $Product_images_table_Model->store($input);
        $Product_images_table = Product_images_table_Model::find($rid);
        return $this->sendResponse(new Product_images_table_Resource($Product_images_table), 'Product_images_table created successfully.');
    } 
   
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $Product_images_table_Model=new Product_images_table_Model();
        
        $Product_images_table = $Product_images_table_Model->show($id);
  
        if (is_null($Product_images_table)) {
            return $this->sendError('Product_images_table not found.');
        }
   
        return $this->sendResponse(new Product_images_table_Resource($Product_images_table), 'Product_images_table retrieved successfully.');
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
        $Product_images_table = Product_images_table_Model::where("status","!=","D")->find($id);
		if($Product_images_table){
			$input = json_decode($request->getContent(),true);
            $validate=array();
                    foreach($input as $key => $value) {
                        //echo "$key: $key\n";
                        // if(array_key_exists("user_id",$input)){
                            // $validate['user_id']="required";
                        // }
						
                        
		 if (array_key_exists('product_id',$input))
			{
				$validate['product_id']= "required";
			} 
		 if (array_key_exists('categ_id',$input))
			{
				$validate['categ_id']= "required";
			} 
		 if (array_key_exists('img_url',$input))
			{
				$validate['img_url']= "required";
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
			$Product_images_table_Model=new Product_images_table_Model();
			$Product_images_tables = $Product_images_table_Model->edit($Product_images_table,$input);
			
            $Product_images_table = Product_images_table_Model::where("status","!=","D")->find($id);
			return $this->sendResponse(new Product_images_table_Resource($Product_images_table), 'Product_images_table updated successfully.');
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
        
        $Product_images_table = Product_images_table_Model::find($id);
  
        if (is_null($Product_images_table)) {
            return $this->sendError('Value not found.');
        }else{
            $Product_images_table_Model=new Product_images_table_Model();
           $Product_images_table_Model->remove($Product_images_table);
            return $this->sendResponse([], 'Product_images_table deleted successfully.');
        }
       
    }
}