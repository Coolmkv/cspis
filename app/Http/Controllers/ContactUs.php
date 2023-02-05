<?php

namespace App\Http\Controllers;

use App\Models\ContactUs as ModelsContactUs;
use App\Traits\CommonFunctions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactUs extends Controller
{
    use CommonFunctions;
    public function contactUsSubmit(Request $request){
        $validate = Validator::make($request->all(),[
            "username"=>"required",
            "email"=>"required|email",
            "phone_number"=>"required|numeric",
            "topic"=>"required|in:Admission,Carrier,Scholarship,Others",
            "message"=>"required|string",
            "captcha"=>"required|captcha"
        ],[
            "captcha.captcha"=>"Invalid Capthca text"
        ]);
        if($validate->fails()){
            $return = $this->getJsonResponse($validate->getMessageBag()->first());
        }else{
            ModelsContactUs::insert([
                ModelsContactUs::NAME=>$request->input("email"),
                ModelsContactUs::EMAIL=>$request->input("email"),
                ModelsContactUs::MOBILE=>$request->input("phone_number"),
                ModelsContactUs::TOPIC=>$request->input("topic"),
                ModelsContactUs::MESSAGE=>$request->input("message")
            ]);
            $return = $this->getJsonResponse("Your query submitted successfully.",null,true);
        }
        return response()->json($return);
    }
}

