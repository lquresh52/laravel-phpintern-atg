<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Data;
use App\Mail\WelcomeMail;
use Exception;
use App\Traits\MailTraits;
use Illuminate\Http\Request;

class ATGController extends Controller
{
    use MailTraits;

    public function index(){

    	return view('index')->with(['sucess_msg'=>'','pin_error_msg'=>'','messages'=>'','duplicate_data'=>'']);
    }

    public function data_store(Request $request){

    	// dd($request->all());
    	// $messages = ['user_name.required'=>'Name is required.','email.required'=>'Email is required.','user_name.unique'=>'Name already in use.'];

    	// $this->validate($request , [
    	// 	'user_name' => 'required|unique:data,user_name',
    	// 	'gmail_id' => 'required|unique:data,gmail_id',
    	// 	'pincode' => 'required|unique:data,pincode|max:6',
		// ]);

        $userExists1 = Data::where('gmail_id', '=', $request->email)->first();

    	$userExists2 = Data::where('user_name', '=', $request->user_name)->first();

    	$userExists3 = Data::where('pincode', '=', $request->text1)->first();

		if ($userExists1 === null && $userExists2 === null && $userExists3 === null) {

		    // User Not Found Your Stuffs Goes Here..
			$user_name1 = $request->user_name;
	    	$email = $request->email;
	    	$pin_code = $request->text1;

	    	$sucess_msg = 'Data stored sucessfully.';
	    	$pin_error_msg = 'Please enter a valid 6 digit pincode!!!';

	    	if (strlen($pin_code)==6 && strlen($pin_code)>0) {

	    		$data = new Data;

	    		$data->user_name = $user_name1;
	    		$data->gmail_id = $email;
	    		$data->pincode = $pin_code;

	    		$data->save();
                // Traits function call for sending e-mails;
                $this->send_mail($email,$user_name1);


                Log::info('----------Data Saved sucessfully. ---------------------');
	    		return view('index')->with(['sucess_msg'=>$sucess_msg,'pin_error_msg'=>'','duplicate_data'=>'']);
	    	}
	    	else{
				Log::error('---------------------- PINCODE NOT ENTERED PROPPERLY  ---------------------');
	    		return view('index')->with(['pin_error_msg'=>$pin_error_msg,'sucess_msg'=>'','duplicate_data'=>'']);
	    	}
		}
		else{
			Log::warning('----------------------  User already exists.  ---------------------');
			return view('index')->with(['sucess_msg'=>'','pin_error_msg'=>'','duplicate_data'=>'User already exists.']);
		}


    }
}
// to see all file on heroku
// heroku run bash -a phpintern-atg
