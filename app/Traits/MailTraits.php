<?php

namespace App\Traits;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeMail;
use Exception;


trait MailTraits{

    public function send_mail($email , $user_name)
    {
        try{
            Mail::to($email)->send(new WelcomeMail($user_name,'Your data is stored sucessfully !!!!!!!!!!!!!!!!!!!!!!!!'));
        }catch( Exception $e){
            Log::info('-------- MAIL SENT FAILED ERROR --------');
            Log::alert($e);
        }

        if (count(Mail::failures()) > 0) {
            Log::error("------------- MAIL SENT FAILED -------------");
        }else{
            Log::info("------------- MAIL SENT -------------");
        }
    }

}
