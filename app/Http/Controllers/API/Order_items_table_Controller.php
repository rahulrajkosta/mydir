<?php
   
namespace App\Http\Controllers\API;
   
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Order_items_table_Model;
use Validator;
use App\Http\Resources\Order_items_table_Resource;
   
class Order_items_table_Controller extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Order_items_table_Model=new Order_items_table_Model();
        
        $Order_items_tables = $Order_items_table_Model->index();
    
        return $this->sendResponse(Order_items_table_Resource::collection($Order_items_tables), 'Order_items_tables retrieved successfully.');
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
			 'product_id' => 'required', 
			 'design_id' => 'required', 
			 'qty' => 'required', 
			 'taxes' => 'required', 
			 'unit_price' => 'required', 
			  
			 
        ]);
    
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
        
        $Order_items_table_Model=new Order_items_table_Model();
        $rid = $Order_items_table_Model->store($input);
        $Order_items_table = Order_items_table_Model::find($rid);
        return $this->sendResponse(new Order_items_table_Resource($Order_items_table), 'Order_items_table created successfully.');
    } 
   
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $Order_items_table_Model=new Order_items_table_Model();
        
        $Order_items_table = $Order_items_table_Model->show($id);
  
        if (is_null($Order_items_table)) {
            return $this->sendError('Order_items_table not found.');
        }
   
        return $this->sendResponse(new Order_items_table_Resource($Order_items_table), 'Order_items_table retrieved successfully.');
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
        $Order_items_table = Order_items_table_Model::where("status","!=","D")->find($id);
		if($Order_items_table){
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
		 if (array_key_exists('product_id',$input))
			{
				$validate['product_id']= "required";
			} 
		 if (array_key_exists('design_id',$input))
			{
				$validate['design_id']= "required";
			} 
		 if (array_key_exists('qty',$input))
			{
				$validate['qty']= "required";
			} 
		 if (array_key_exists('taxes',$input))
			{
				$validate['taxes']= "required";
			} 
		 if (array_key_exists('unit_price',$input))
			{
				$validate['unit_price']= "required";
			} 
		 
                          
                      } 
			$validator = Validator::make($input,$validate); 
	   
			if($validator->fails()){
				return $this->sendError('Validation Error.', $validator->errors());       
			}
			$Order_items_table_Model=new Order_items_table_Model();
			$Order_items_tables = $Order_items_table_Model->edit($Order_items_table,$input);
			
            $Order_items_table = Order_items_table_Model::where("status","!=","D")->find($id);
			return $this->sendResponse(new Order_items_table_Resource($Order_items_table), 'Order_items_table updated successfully.');
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
        
        $Order_items_table = Order_items_table_Model::find($id);
  
        if (is_null($Order_items_table)) {
            return $this->sendError('Value not found.');
        }else{
            $Order_items_table_Model=new Order_items_table_Model();
           $Order_items_table_Model->remove($Order_items_table);
            return $this->sendResponse([], 'Order_items_table deleted successfully.');
        }
       
    }
}