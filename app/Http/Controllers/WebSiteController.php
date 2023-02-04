<?php

namespace App\Http\Controllers;

use App\Models\StudentRegistration;
use App\Traits\CommonFunctions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Razorpay\Api\Api;
use Captcha;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class WebSiteController extends Controller
{
    use CommonFunctions;
    public function aboutUs()
    {
        return view("WebSitePages.about_us");
    }

    public function contactUs(){
        return view("WebSitePages.contact_us");
    }

    public function registerStudent(){
        return view("WebSitePages.registerStudent");
    }

    public function scholarship()
    {
        return view("WebSitePages.scholarShip");
    }

    public function razorpay(){

    }
    public function payment(Request $request)
    {        
        $input = $request->all();        
        $api = new Api(env('RAZOR_KEY'), env('RAZOR_SECRET'));
        $payment = $api->payment->fetch($input['razorpay_payment_id']);

        if(count($input)  && !empty($input['razorpay_payment_id'])) 
        {
            try 
            {
                $response = $api->payment->fetch($input['razorpay_payment_id'])->capture(array('amount'=>$payment['amount'])); 

            } 
            catch (\Exception $e) 
            {
                return  $e->getMessage();
                Session::put('error',$e->getMessage());
                return redirect()->back();
            }            
        }
        
        Session::put('success', 'Payment successful, your order will be despatched in the next 48 hours.');
        return redirect()->back();
    }

    public function refreshCapthca(){
        try{
            $return = ["status"=>true,"message"=>"Success","data"=>Captcha::src()];
            
        }catch(Exception $exception){
            $return = ["status"=>false,"message"=>$exception->getMessage(),"data"=>$exception->getTraceAsString()];
        }
        return response()->json($return);
    }

    public function registerStudentInfo(Request $request){
        try{
            $validate = Validator::make($request->all(),
            [
                "fname"=>"required|string",
                "lname"=>"required|string",
                "father_name"=>"required|string",
                "gender"=>"required|string",
                "dob"=>"required|date|before_or_equal:2012-01-01",
                "aadhar_number"=>"required|numeric|digits_between:12,12",
                "religion"=>"required|string",
                "category"=>"required|string",
                "address"=>"required|string",
                "district"=>"required|string",
                "state"=>"required|string",
                "pincode"=>"required|string",
                "mobile"=>"required|string",
                "photo"=>"required|image",
                "signature"=>"required|image",
                "class_passed"=>"required|string",
                "year_of_passing"=>"required|string",
                "board"=>"required|string",
                "captcha"=>"required|captcha",
                "school"=>"required|string"
            ],[
                "captcha.captcha"=>"Invalid captcha"
            ]);
            if($validate->fails()){
                $return  = $this->getJsonResponse($validate->getMessageBag()->first());
            }else{
                $return = (new StudentRegistration())->registerStudent($request);
            }

        }catch(Exception $exception){
            Log::critical($exception->getMessage());
            Log::critical($exception->getTraceAsString());
            $return  = $this->getJsonResponse();
        }
        return response()->json($return);
    }

    public function completePurchase(){
        try{

            if(session()->has("student_id") && session()->has("registration_fee")){
                if(session("registration_fee")>0){
                    $return = view("WebSitePages.payment_page");
                }else{
                    $return = redirect()->back()->with("error","purchase_info error.");
                }
                
            }else{
                $return =  redirect()->back()->with("error","purchase_info not found.");
            }
        }catch(Exception $exception){
            Log::critical($exception->getMessage());
            $return = redirect()->back()->with("error","error in purchase.");
        }
        return $return;
    }
}
