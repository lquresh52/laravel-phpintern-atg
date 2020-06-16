<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Traits\MailTraits;
use App\Data;
use Validator;

class WebServicesController extends Controller
{
    use MailTraits;

    public function get_alluser_data(){
        return response()->json(Data::get() , 200);
    }

    public function get_user_data_byid($id){
        $data = Data::find($id);
        if (is_null($data)){
            return response()->json(["message" => 'Record not Found!!'] , 404);
        }
        return response()->json($data , 200);
    }

    public function post_user_data_save(Request $request){

        // echo $request->email;

        $rules = [
            'user_name' => 'required|min:3|unique:data,user_name',
            'gmail_id' => 'required|min:2|unique:data,gmail_id',
            'pincode' => 'required|min:6|max:6|unique:data,pincode',
        ];

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()){
            // return response()->json($validator->errors(), 400);
            return response()->json($validator->errors(), 200);
        }

        $data = Data::create($request->all());

        // Traits function call for sending e-mails;

        $this->send_mail($request->gmail_id,$request->user_name);

        Log::info('Data stored sucessfully.');

        return response()->json(['message'=>'Data stored sucessfully!!!'] , 200);

    }


    public function post_user_datasave(Request $request)
    {
        return response()->json(['message' => 'Your form data has been submitted'] , 200);
    }



    public function put_update_user_data(Request $request , $id){
        $data = Data::find($id);
        if (is_null($data)){
            return response()->json(["message" => 'Record not Found!!'] , 404);
        }
        $data->update($request->all());
        return response()->json($data, 200);
    }

    public function delete_user_data(Request $request , $id){
        $data = Data::find($id);
        if (is_null($data)){
            return response()->json(["message" => 'Record not Found!!'] , 404);
        }
        $data->delete();
        return response()->json(null,204);
    }



}
