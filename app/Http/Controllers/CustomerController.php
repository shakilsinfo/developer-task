<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Models\UserType;
use Session;
use Validator;
class CustomerController extends Controller
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
                    ->paginate(10);
       return view('customer.index',compact('allCustomer'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        return view('customer.add-edit');
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
                    'name' => 'required',
                    'email' => 'email|required|unique:users',
                    'phone_number' => 'required',
                    'present_address' => 'required'
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
        $input['user_type'] = 2;
        $input['password'] = bcrypt($request->password);
        try{
            $bug=0;
            User::create($input);
        
        }catch(\Exception $e){
            $bug=$e->getMessage();
        }
        if($bug===0){

        
            Session::flash('flash_message','Customer Successfully Added.');
            return redirect('customer-list')->with('status_color','success');
        }else{
            Session::flash('flash_message',$bug);
            return redirect('customer-list')->with('status_color','danger');
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
        
        $data['customer_data'] = User::findOrFail($id);
        return view('customer.add-edit',$data);
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
        $data= User::findOrFail($id);

        $validator = Validator::make($request->all(), [
                    'name'  => 'required',
                    'email' => 'email|required',
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

            Session::flash('flash_message','Customer Successfully Updated.');
            return redirect('customer-list')->with('status_color','success');
        }else{
            Session::flash('flash_message',$result);
            return redirect('customer-list')->with('status_color','danger');
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
        $data = User::findOrFail($id);
        
        $action = $data->delete();

        if($action)
        {
            Session::flash('flash_message','Customer Successfully Deleted.');
            return redirect('customer-list')->with('status_color','danger');
        }
        else
        {
            Session::flash('flash_message','Something Error Found.');
            return redirect('customer-list')->with('status_color','danger');
        }
    }
}
