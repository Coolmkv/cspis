<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\StudentRegistration;
use App\Traits\CommonFunctions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Razorpay\Api\Api;
use Captcha;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
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

    public function razorpay(Request $request){
        $input = $request->all();
        $api = new Api (env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
        $payment = $api->payment->fetch($input['razorpay_payment_id']);
        if(count($input) && !empty($input['razorpay_payment_id'])) {
            try {
                $response = $api->payment->fetch($input['razorpay_payment_id'])->capture(array('amount' => $payment['amount']));
                $payment = Payment::create([
                    'r_payment_id' => $response['id'],
                    'method' => $response['method'],
                    'currency' => $response['currency'],
                    'user_email' => $response['email'],
                    'amount' => $response['amount']/100,
                    'json_response' => json_encode((array)$response)
                ]);
            } catch(Exception $e) {
                return $e->getMessage();
                Session::put('error',$e->getMessage());
                return redirect()->back();
            }
        }
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

    public function getRandom(){
        $random = "IN".session("student_id").Str::random(15);
        return substr(strtoupper($random),0,15);
    }

    public function checkPayment(Request $request)
    {        
        $input = $request->all();        
        $api = new Api(env('RAZOR_KEY'), env('RAZOR_SECRET'));
        $payment = $api->payment->fetch($input['razorpay_payment_id']);

        if(count($input)  && !empty($input['razorpay_payment_id'])) 
        {
            try 
            {
                $response = $api->payment->fetch($input['razorpay_payment_id'])->capture(array('amount'=>$payment['amount'])); 
                if(session("registration_fee")==$response["amount"]){
                    $invoice_number = $this->getRandom();
                    Payment::insert([
                        Payment::R_PAYMENT_ID=>$response['id'],
                        Payment::METHOD=>$response["method"],
                        Payment::CURRENCY=>$response["currency"],
                        Payment::USER_EMAIL=>$response["email"],
                        Payment::AMOUNT=>$response["amount"]/100,
                        Payment::JSON_RESPONSE=>json_encode((array)$response),
                        Payment::STUDENT_ID=>session("student_id"),
                        Payment::INVOICE_NUMBER=>$invoice_number
                    ]);
                    session(["invoice_student_id"=>session("student_id")]);
                    $return  = redirect(route("paymentSuccess"));
                    //session()->forget("student_id");
                    //session()->forget("registration_fee");
                }else{
                    $return = redirect()->back()->with("error","Invalid Amount");
                }                
            } 
            catch (Exception $exception) 
            {
                Log::critical($exception->getMessage());
                $return =  redirect("")->with("error",$exception->getMessage());
            }            
        }else{
            $return =  redirect("")->with("error","Invalid payment response.");
        }
        return $return;
    }
    public function paymentSuccess(){
        if(session()->has("invoice_student_id")){
            $studentInfo = StudentRegistration::find(session("invoice_student_id"));
            $payments = Payment::where(Payment::STUDENT_ID,session("invoice_student_id"))->first([
                Payment::AMOUNT,Payment::CURRENCY,Payment::INVOICE_NUMBER,Payment::METHOD
            ]);
            if(empty($studentInfo) || empty($payments)){
                $return = redirect("")->with("error","Student details not found.");
            }else{
                $data = ["payment_info"=>$payments,"studentInfo"=>$studentInfo,"registration_date"=>date("F d, Y")];
                $return = view("WebSitePages.paymentSuccess",$data);
            }
        }else{
            $return = redirect("")->with("error","Invalid request.");
        }
        return $return;
    }
}
