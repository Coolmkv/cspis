<?php

namespace App\Models;

use App\Traits\CommonFunctions;
use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class StudentRegistration extends Model
{
    use HasFactory;

    protected $table = "student_registration";

    const TABLE_NAME = "student_registration";

    const ID = "id";
    const FIRST_NAME = "first_name";
    const LAST_NAME = "last_name";
    const FATHER_NAME = "father_name";
    const GENDER = "gender";
    const DATE_OF_BIRTH = "date_of_birth";
    const AADHAR_NUMBER = "aadhar_number";
    const RELIGION = "religion";
    const CATEGORY = "category";
    const ADDRESS = "address";
    const DISTRICT = "district";
    const STATE = "state";
    const PINCODE = "pincode";
    const CONTACT_NUMBER = "contact_number";
    const PHOTO = "photo";
    const SIGNATURE = "signature";
    const CLASS_PASSED = "class_passed";
    const YEAR_OF_PASSING = "year_of_passing";
    const PASSING_BOARD = "passing_board";
    const SCHOOL = "school";
    const CREATED_AT = "created_at";
    const UPDATED_AT = "updated_at";
    const PHOTO_PATH = "/upload/photos/images/";
    const SIGNATURE_IMG = "/upload/photos/signature/";

    const ID_ALIAS = "student_registration.id";
    use CommonFunctions;
    public function registerStudent(Request $request){
        try{
            $insert = [
                self::FIRST_NAME=>$request->input("fname"),
                self::LAST_NAME=>$request->input("lname"),
                self::FATHER_NAME=>$request->input("father_name"),
                self::GENDER=>$request->input("gender"),
                self::DATE_OF_BIRTH=>$request->input("dob"),
                self::AADHAR_NUMBER=>$request->input("aadhar_number"),
                self::RELIGION=>$request->input("religion"),
                self::CATEGORY=>$request->input("category"),
                self::ADDRESS=>$request->input("address"),
                self::DISTRICT=>$request->input("district"),
                self::STATE=>$request->input("state"),
                self::PINCODE=>$request->input("pincode"),
                self::CONTACT_NUMBER=>$request->input("mobile"),
                self::PHOTO=>$request->input("photo"),
                self::SIGNATURE=>$request->input("signature"),
                self::CLASS_PASSED=>$request->input("class_passed"),
                self::YEAR_OF_PASSING=>$request->input("year_of_passing"),
                self::PASSING_BOARD=>$request->input("board"),
                self::SCHOOL=>$request->input("school"),
            ];
            $maxId = self::max(self::ID);
            if(empty($maxId)){
                $maxId = 1;
            }else{
                $maxId++;
            }
            $photo = $request->file(self::PHOTO);
            $fileName = $photo->getClientOriginalName();
            $fileName = "PhotoImg_$maxId".preg_replace('/[^A-Za-z0-9.\-]/', '', $fileName);
            $photo->move(public_path().self::PHOTO_PATH, $fileName);
            $insert[self::PHOTO] = self::PHOTO_PATH.$fileName;

            $signature = $request->file(self::SIGNATURE);
            $fileName = $signature->getClientOriginalName();
            $fileName = "SignatureImg_$maxId".preg_replace('/[^A-Za-z0-9.\-]/', '', $fileName);
            $signature->move(public_path().self::SIGNATURE_IMG, $fileName);
            $insert[self::SIGNATURE] = self::SIGNATURE_IMG.$fileName;
            $student_id = self::insertGetId($insert);
            if($student_id){
                
                if(in_array($request->input("class_passed"),["7th","8th","9th"])){
                    $registration_fee = 14900;
                }else{
                    $registration_fee = 29900;
                }
                session(["student_id"=>$student_id,"registration_fee"=>$registration_fee]);
                $return = $this->getJsonResponse("saved",$student_id,true,true);
            }else{
                $return = $this->getJsonResponse();
            }
            
        }catch(Exception $exception){
            $return  = $this->getJsonResponse($exception->getMessage(),null,false,true);
        }
        return $return;
    }
}
