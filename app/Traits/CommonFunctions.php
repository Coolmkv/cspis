<?php
namespace App\Traits;

use Exception;
use Illuminate\Support\Facades\Log;

trait CommonFunctions{

    public function reportException(Exception $exception){
        dd([
            "message"=>$exception->getMessage(),
            "File"=>$exception->getFile(),
            "Code"=>$exception->getCode(),
            "Trace as string"=>$exception->getTraceAsString()
        ]);
    }

    public function getJsonResponse($message = "Something went wrong.",$data = null,bool $status=false,$logging = false){
        $return = ["status"=>$status,"message"=>$message,"data"=>$data];
        if($logging){
            Log::info(json_encode($return));
        }
        return $return;
    }

}