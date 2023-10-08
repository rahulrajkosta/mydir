<?php
   
namespace App\Http\Controllers\API;
   
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Payment_transactions_table_Model;
use Validator;
use App\Http\Resources\Payment_transactions_table_Resource;
   
class Payment_transactions_table_Controller extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Payment_transactions_table_Model=new Payment_transactions_table_Model();
        
        $Payment_transactions_tables = $Payment_transactions_table_Model->index();
    
        return $this->sendResponse(Payment_transactions_table_Resource::collection($Payment_transactions_tables), 'Payment_transactions_tables retrieved successfully.');
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
			 'user_id' => 'required', 
			 'tr_date' => 'required', 
			 'pay_amount' => 'required', 
			 'pay_status' => 'required', 
			 'gateway_details' => 'required', 
			  
			 
        ]);
    
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
        
        $Payment_transactions_table_Model=new Payment_transactions_table_Model();
        $rid = $Payment_transactions_table_Model->store($input);
        $Payment_transactions_table = Payment_transactions_table_Model::find($rid);
        return $this->sendResponse(new Payment_transactions_table_Resource($Payment_transactions_table), 'Payment_transactions_table created successfully.');
    } 
   
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $Payment_transactions_table_Model=new Payment_transactions_table_Model();
        
        $Payment_transactions_table = $Payment_transactions_table_Model->show($id);
  
        if (is_null($Payment_transactions_table)) {
            return $this->sendError('Payment_transactions_table not found.');
        }
   
        return $this->sendResponse(new Payment_transactions_table_Resource($Payment_transactions_table), 'Payment_transactions_table retrieved successfully.');
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
        $Payment_transactions_table = Payment_transactions_table_Model::where("status","!=","D")->find($id);
		if($Payment_transactions_table){
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
		 if (array_key_exists('user_id',$input))
			{
				$validate['user_id']= "required";
			} 
		 if (array_key_exists('tr_date',$input))
			{
				$validate['tr_date']= "required";
			} 
		 if (array_key_exists('pay_amount',$input))
			{
				$validate['pay_amount']= "required";
			} 
		 if (array_key_exists('pay_status',$input))
			{
				$validate['pay_status']= "required";
			} 
		 if (array_key_exists('gateway_details',$input))
			{
				$validate['gateway_details']= "required";
			} 
		 
                          
                      } 
			$validator = Validator::make($input,$validate); 
	   
			if($validator->fails()){
				return $this->sendError('Validation Error.', $validator->errors());       
			}
			$Payment_transactions_table_Model=new Payment_transactions_table_Model();
			$Payment_transactions_tables = $Payment_transactions_table_Model->edit($Payment_transactions_table,$input);
			
            $Payment_transactions_table = Payment_transactions_table_Model::where("status","!=","D")->find($id);
			return $this->sendResponse(new Payment_transactions_table_Resource($Payment_transactions_table), 'Payment_transactions_table updated successfully.');
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
        
        $Payment_transactions_table = Payment_transactions_table_Model::find($id);
  
        if (is_null($Payment_transactions_table)) {
            return $this->sendError('Value not found.');
        }else{
            $Payment_transactions_table_Model=new Payment_transactions_table_Model();
           $Payment_transactions_table_Model->remove($Payment_transactions_table);
            return $this->sendResponse([], 'Payment_transactions_table deleted successfully.');
        }
       
    }
}