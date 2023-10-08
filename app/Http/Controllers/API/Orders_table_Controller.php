<?php
   
namespace App\Http\Controllers\API;
   
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Orders_table_Model;
use Validator;
use App\Http\Resources\Orders_table_Resource;
   
class Orders_table_Controller extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Orders_table_Model=new Orders_table_Model();
        
        $Orders_tables = $Orders_table_Model->index();
    
        return $this->sendResponse(Orders_table_Resource::collection($Orders_tables), 'Orders_tables retrieved successfully.');
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
			 'order_date' => 'required', 
			 't_amount' => 'required', 
			 'order_status' => 'required', 
			 'shipping_method' => 'required', 
			 'payment_method' => 'required', 
			 'payment_status' => 'required', 
			  
			 
        ]);
    
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
        
        $Orders_table_Model=new Orders_table_Model();
        $rid = $Orders_table_Model->store($input);
        $Orders_table = Orders_table_Model::find($rid);
        return $this->sendResponse(new Orders_table_Resource($Orders_table), 'Orders_table created successfully.');
    } 
   
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $Orders_table_Model=new Orders_table_Model();
        
        $Orders_table = $Orders_table_Model->show($id);
  
        if (is_null($Orders_table)) {
            return $this->sendError('Orders_table not found.');
        }
   
        return $this->sendResponse(new Orders_table_Resource($Orders_table), 'Orders_table retrieved successfully.');
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
        $Orders_table = Orders_table_Model::where("status","!=","D")->find($id);
		if($Orders_table){
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
		 if (array_key_exists('order_date',$input))
			{
				$validate['order_date']= "required";
			} 
		 if (array_key_exists('t_amount',$input))
			{
				$validate['t_amount']= "required";
			} 
		 if (array_key_exists('order_status',$input))
			{
				$validate['order_status']= "required";
			} 
		 if (array_key_exists('shipping_method',$input))
			{
				$validate['shipping_method']= "required";
			} 
		 if (array_key_exists('payment_method',$input))
			{
				$validate['payment_method']= "required";
			} 
		 if (array_key_exists('payment_status',$input))
			{
				$validate['payment_status']= "required";
			} 
		 
                          
                      } 
			$validator = Validator::make($input,$validate); 
	   
			if($validator->fails()){
				return $this->sendError('Validation Error.', $validator->errors());       
			}
			$Orders_table_Model=new Orders_table_Model();
			$Orders_tables = $Orders_table_Model->edit($Orders_table,$input);
			
            $Orders_table = Orders_table_Model::where("status","!=","D")->find($id);
			return $this->sendResponse(new Orders_table_Resource($Orders_table), 'Orders_table updated successfully.');
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
        
        $Orders_table = Orders_table_Model::find($id);
  
        if (is_null($Orders_table)) {
            return $this->sendError('Value not found.');
        }else{
            $Orders_table_Model=new Orders_table_Model();
           $Orders_table_Model->remove($Orders_table);
            return $this->sendResponse([], 'Orders_table deleted successfully.');
        }
       
    }
}