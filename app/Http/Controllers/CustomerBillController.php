<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Models\UserType;
use App\Models\CustomerBill;
use Session;
use Validator;
class CustomerBillController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $allCustomer = User::where('user_type',2)
                    ->orderBy('id','desc')
                    ->get();
        $billList = CustomerBill::orderBy('id','desc')->paginate(20);
       return view('customer-bill.index',compact('allCustomer','billList'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    
    public function store(Request $request)
    {
         $validator = Validator::make($request->all(), [
                    'customer_id' => 'required',
                    'amount' => 'required',
                    'bill_month' => 'required',
                    'year' => 'required'
                ]);

        if($validator->fails())
        {
            $plainErrorText = "";
            $errorMessage = json_decode($validator->messages(), True);
            foreach ($errorMessage as $value) { 
                $plainErrorText .= $value[0].". ";
            }
            Session::flash('flash_message', $plainErrorText);
            return redirect()->back()->withErrors($validator)->withInput()->with('status_color','warning');
        }
                
        $input = $request->all();
        
        try{
            $bug=0;
            CustomerBill::create($input);
        
        }catch(\Exception $e){
            $bug=$e->getMessage();
        }
        if($bug===0){

        
            Session::flash('flash_message','Customer Bill Generated.');
            return redirect('bill-generate')->with('status_color','success');
        }else{
            Session::flash('flash_message',$bug);
            return redirect('bill-generate')->with('status_color','danger');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
       
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data= CustomerBill::findOrFail($id);

        $validator = Validator::make($request->all(), [
                    'customer_id' => 'required',
                    'amount' => 'required',
                    'bill_month' => 'required',
                    'year' => 'required'
                ]);
        
                if ($validator->fails()) {
                    return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
                }
        $input = $request->all();

        $update = $data->update($input);
        try{
            $result=0;
        }catch(\Exception $e){
                $result = $e->getMessage();
            }

        if($result===0){

            Session::flash('flash_message','Bill Successfully Updated.');
            return redirect('bill-generate')->with('status_color','success');
        }else{
            Session::flash('flash_message',$result);
            return redirect('bill-generate')->with('status_color','danger');
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
        $data = CustomerBill::findOrFail($id);
        
        $action = $data->delete();

        if($action)
        {
            Session::flash('flash_message','Bill Successfully Deleted.');
            return redirect('bill-generate')->with('status_color','danger');
        }
        else
        {
            Session::flash('flash_message','Something Error Found.');
            return redirect('bill-generate')->with('status_color','danger');
        }
    }
}
