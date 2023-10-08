<?php
   
namespace App\Http\Controllers\API;
   
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Products_table_Model;
use Validator;
use App\Http\Resources\Products_table_Resource;
   
class Products_table_Controller extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Products_table_Model=new Products_table_Model();
        
        $Products_tables = $Products_table_Model->index();
    
        return $this->sendResponse(Products_table_Resource::collection($Products_tables), 'Products_tables retrieved successfully.');
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
			 'categ_id' => 'required', 
			 'names' => 'required', 
			 'desc' => 'required', 
			 'price' => 'required', 
			 'invent_qty' => 'required', 
			 'bag_color' => 'required', 
			 'css_style' => 'required', 
			  
			 
        ]);
    
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
        
        $Products_table_Model=new Products_table_Model();
        $rid = $Products_table_Model->store($input);
        $Products_table = Products_table_Model::find($rid);
        return $this->sendResponse(new Products_table_Resource($Products_table), 'Products_table created successfully.');
    } 
   
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $Products_table_Model=new Products_table_Model();
        
        $Products_table = $Products_table_Model->show($id);
  
        if (is_null($Products_table)) {
            return $this->sendError('Products_table not found.');
        }
   
        return $this->sendResponse(new Products_table_Resource($Products_table), 'Products_table retrieved successfully.');
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
        $Products_table = Products_table_Model::where("status","!=","D")->find($id);
		if($Products_table){
			$input = json_decode($request->getContent(),true);
            $validate=array();
                    foreach($input as $key => $value) {
                        //echo "$key: $key\n";
                        // if(array_key_exists("user_id",$input)){
                            // $validate['user_id']="required";
                        // }
						
                        
		 if (array_key_exists('categ_id',$input))
			{
				$validate['categ_id']= "required";
			} 
		 if (array_key_exists('names',$input))
			{
				$validate['names']= "required";
			} 
		 if (array_key_exists('desc',$input))
			{
				$validate['desc']= "required";
			} 
		 if (array_key_exists('price',$input))
			{
				$validate['price']= "required";
			} 
		 if (array_key_exists('invent_qty',$input))
			{
				$validate['invent_qty']= "required";
			} 
		 if (array_key_exists('bag_color',$input))
			{
				$validate['bag_color']= "required";
			} 
		 if (array_key_exists('css_style',$input))
			{
				$validate['css_style']= "required";
			} 
		 
                          
                      } 
			$validator = Validator::make($input,$validate); 
	   
			if($validator->fails()){
				return $this->sendError('Validation Error.', $validator->errors());       
			}
			$Products_table_Model=new Products_table_Model();
			$Products_tables = $Products_table_Model->edit($Products_table,$input);
			
            $Products_table = Products_table_Model::where("status","!=","D")->find($id);
			return $this->sendResponse(new Products_table_Resource($Products_table), 'Products_table updated successfully.');
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
        
        $Products_table = Products_table_Model::find($id);
  
        if (is_null($Products_table)) {
            return $this->sendError('Value not found.');
        }else{
            $Products_table_Model=new Products_table_Model();
           $Products_table_Model->remove($Products_table);
            return $this->sendResponse([], 'Products_table deleted successfully.');
        }
       
    }
}