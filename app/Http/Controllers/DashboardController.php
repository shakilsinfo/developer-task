<?php

namespace App\Http\Controllers;


use Session;
use Carbon\Carbon;
use DB;
use Auth;
use App\Models\CustomerBill;
use App\User;
class DashboardController extends Controller
{	
	public function index()
    {
       if(Auth::User()->user_type ==2){
       	$data['bill_history'] = CustomerBill::where('customer_id',Auth::User()->id)->get();
       	return view('customer-dashboard',$data);
       }else{

        return view('dashboard');
       }
    }
	 
}
