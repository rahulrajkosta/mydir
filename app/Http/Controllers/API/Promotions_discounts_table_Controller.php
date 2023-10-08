<?php
   
namespace App\Http\Controllers\API;
   
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Promotions_discounts_table_Model;
use Validator;
use App\Http\Resources\Promotions_discounts_table_Resource;
   
class Promotions_discounts_table_Controller extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Promotions_discounts_table_Model=new Promotions_discounts_table_Model();
        
        $Promotions_discounts_tables = $Promotions_discounts_table_Model->index();
    
        return $this->sendResponse(Promotions_discounts_table_Resource::collection($Promotions_discounts_tables), 'Promotions_discounts_tables retrieved successfully.');
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
			 'promo_code' => 'required', 
			 'discount' => 'required', 
			 'exp_date' => 'required', 
			 'applicable_products' => 'required', 
			  
			 
        ]);
    
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
        
        $Promotions_discounts_table_Model=new Promotions_discounts_table_Model();
        $rid = $Promotions_discounts_table_Model->store($input);
        $Promotions_discounts_table = Promotions_discounts_table_Model::find($rid);
        return $this->sendResponse(new Promotions_discounts_table_Resource($Promotions_discounts_table), 'Promotions_discounts_table created successfully.');
    } 
   
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $Promotions_discounts_table_Model=new Promotions_discounts_table_Model();
        
        $Promotions_discounts_table = $Promotions_discounts_table_Model->show($id);
  
        if (is_null($Promotions_discounts_table)) {
            return $this->sendError('Promotions_discounts_table not found.');
        }
   
        return $this->sendResponse(new Promotions_discounts_table_Resource($Promotions_discounts_table), 'Promotions_discounts_table retrieved successfully.');
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
        $Promotions_discounts_table = Promotions_discounts_table_Model::where("status","!=","D")->find($id);
		if($Promotions_discounts_table){
			$input = json_decode($request->getContent(),true);
            $validate=array();
                    foreach($input as $key => $value) {
                        //echo "$key: $key\n";
                        // if(array_key_exists("user_id",$input)){
                            // $validate['user_id']="required";
                        // }
						
                        
		 if (array_key_exists('promo_code',$input))
			{
				$validate['promo_code']= "required";
			} 
		 if (array_key_exists('discount',$input))
			{
				$validate['discount']= "required";
			} 
		 if (array_key_exists('exp_date',$input))
			{
				$validate['exp_date']= "required";
			} 
		 if (array_key_exists('applicable_products',$input))
			{
				$validate['applicable_products']= "required";
			} 
		 
                          
                      } 
			$validator = Validator::make($input,$validate); 
	   
			if($validator->fails()){
				return $this->sendError('Validation Error.', $validator->errors());       
			}
			$Promotions_discounts_table_Model=new Promotions_discounts_table_Model();
			$Promotions_discounts_tables = $Promotions_discounts_table_Model->edit($Promotions_discounts_table,$input);
			
            $Promotions_discounts_table = Promotions_discounts_table_Model::where("status","!=","D")->find($id);
			return $this->sendResponse(new Promotions_discounts_table_Resource($Promotions_discounts_table), 'Promotions_discounts_table updated successfully.');
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
        
        $Promotions_discounts_table = Promotions_discounts_table_Model::find($id);
  
        if (is_null($Promotions_discounts_table)) {
            return $this->sendError('Value not found.');
        }else{
            $Promotions_discounts_table_Model=new Promotions_discounts_table_Model();
           $Promotions_discounts_table_Model->remove($Promotions_discounts_table);
            return $this->sendResponse([], 'Promotions_discounts_table deleted successfully.');
        }
       
    }
}