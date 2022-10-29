<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Devfaysal\BangladeshGeocode\Models\Division;
use Devfaysal\BangladeshGeocode\Models\District;
use App\Models\AgentCustomer;


class AgentCustomerController extends Controller
{

  function generateRandomString($length = 6)
  {
      $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
      $charactersLength = strlen($characters);
      $randomString = '';
      for ($i = 0; $i < $length; $i++) {
          $randomString .= $characters[rand(0, $charactersLength - 1)];
      }
      return
          $randomString;
  }
     
    

    public function storeCustomer(Request $request){
       
          $request->validate([
            'customer_id' => 'required',
            'customer_name' => 'required',
            'customer_email' => 'required|unique:agent_customers',
            'customer_mobile' => 'required',
            'customer_division' => 'required',
            'customer_area' => 'required',
            'customer_address' => 'required',
        ]);
        $AgentCustomer=AgentCustomer::insert([
            'customer_id' => $request->customer_id,
            'customer_name' => $request->customer_name,
            'customer_email' => $request->customer_email,
            'customer_mobile' => $request->customer_mobile,
            'customer_division' => $request->customer_division,
            'customer_area' => $request->customer_area,
            'customer_address' => $request->customer_address,

        ]);
        return response($AgentCustomer);
    }

    public function editCustomer($customer_id){
        $AgentCustomer = AgentCustomer::find($customer_id);
        if(!$AgentCustomer){
            return response()->json(['error'=>"Customer not found"]);
        }
        return response()->json(['customer'=>$AgentCustomer]);
    }
    public function delete($customer_id){
       
        $AgentCustomerDel =AgentCustomer::find($customer_id)->delete();
        return response($AgentCustomerDel);
       
       
    }
    public function validateStatus()
    {
        return $this->validate(request(), [
            'id' => 'required|min:1|max:3'
        ]);
    }
    public function updateCustomer(Request $request, $customer_id){
        // dd($request->all());

        $AgentCustomer = AgentCustomer::find($customer_id);
        if(!$AgentCustomer){
            return response()->json(['error'=>"Customer not found"]);
        }
       
        $data =AgentCustomer::find($customer_id)->updateOrCreate([
            'customer_id'=>$request->customer_id,
            'customer_name'=>$request->customer_name,
            'customer_email'=>$request->customer_email,
            'customer_mobile'=>$request->customer_mobile,
            'customer_division'=>$request->customer_division,
            'customer_area'=>$request->customer_area,
            'customer_address'=>$request->customer_address
        ]);
       
         return response()->json($data);
    }

    public function CustomerViewPage(){ 
        $customer = AgentCustomer::OrderBy('id','desc')->get();
        $divisions = Division::all();
        $districts = District::all();
        $customer_id='#' . $this->generateRandomString();
        return view('agent.viewCustomer',compact('customer','districts','divisions','customer_id'));
       
    }

    public function CustomergetData(){
        $customer = AgentCustomer::OrderBy('id','desc')->get();
        $districts = District::orderBy('id','desc')->get();
        $divisions = Division::orderBy('id','desc')->get();
        // return response(compact('customer','districts','divisions'));
        return response()->json(['customer'=>$customer,
         'districts'=> $districts,'divisions'=> $divisions]);
    }


}
