<?php
   
namespace App\Http\Controllers\API;
   
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Shipping_information_table_Model;
use Validator;
use App\Http\Resources\Shipping_information_table_Resource;
   
class Shipping_information_table_Controller extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Shipping_information_table_Model=new Shipping_information_table_Model();
        
        $Shipping_information_tables = $Shipping_information_table_Model->index();
    
        return $this->sendResponse(Shipping_information_table_Resource::collection($Shipping_information_tables), 'Shipping_information_tables retrieved successfully.');
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
			 'order_id' => 'required', 
			 'receipent_name' => 'required', 
			 'shipping' => 'required', 
			 'delivery_date' => 'required', 
			 'track_information' => 'required', 
			  
			 
        ]);
    
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
        
        $Shipping_information_table_Model=new Shipping_information_table_Model();
        $rid = $Shipping_information_table_Model->store($input);
        $Shipping_information_table = Shipping_information_table_Model::find($rid);
        return $this->sendResponse(new Shipping_information_table_Resource($Shipping_information_table), 'Shipping_information_table created successfully.');
    } 
   
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $Shipping_information_table_Model=new Shipping_information_table_Model();
        
        $Shipping_information_table = $Shipping_information_table_Model->show($id);
  
        if (is_null($Shipping_information_table)) {
            return $this->sendError('Shipping_information_table not found.');
        }
   
        return $this->sendResponse(new Shipping_information_table_Resource($Shipping_information_table), 'Shipping_information_table retrieved successfully.');
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
        $Shipping_information_table = Shipping_information_table_Model::where("status","!=","D")->find($id);
		if($Shipping_information_table){
			$input = json_decode($request->getContent(),true);
            $validate=array();
                    foreach($input as $key => $value) {
                        //echo "$key: $key\n";
                        // if(array_key_exists("user_id",$input)){
                            // $validate['user_id']="required";
                        // }
						
                        
		 if (array_key_exists('order_id',$input))
			{
				$validate['order_id']= "required";
			} 
		 if (array_key_exists('receipent_name',$input))
			{
				$validate['receipent_name']= "required";
			} 
		 if (array_key_exists('shipping',$input))
			{
				$validate['shipping']= "required";
			} 
		 if (array_key_exists('delivery_date',$input))
			{
				$validate['delivery_date']= "required";
			} 
		 if (array_key_exists('track_information',$input))
			{
				$validate['track_information']= "required";
			} 
		 
                          
                      } 
			$validator = Validator::make($input,$validate); 
	   
			if($validator->fails()){
				return $this->sendError('Validation Error.', $validator->errors());       
			}
			$Shipping_information_table_Model=new Shipping_information_table_Model();
			$Shipping_information_tables = $Shipping_information_table_Model->edit($Shipping_information_table,$input);
			
            $Shipping_information_table = Shipping_information_table_Model::where("status","!=","D")->find($id);
			return $this->sendResponse(new Shipping_information_table_Resource($Shipping_information_table), 'Shipping_information_table updated successfully.');
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
        
        $Shipping_information_table = Shipping_information_table_Model::find($id);
  
        if (is_null($Shipping_information_table)) {
            return $this->sendError('Value not found.');
        }else{
            $Shipping_information_table_Model=new Shipping_information_table_Model();
           $Shipping_information_table_Model->remove($Shipping_information_table);
            return $this->sendResponse([], 'Shipping_information_table deleted successfully.');
        }
       
    }
}