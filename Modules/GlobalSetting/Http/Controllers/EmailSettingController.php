<?php

namespace Modules\GlobalSetting\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\EmailConfiguration;
use App\Models\EmailTemplate;

class EmailSettingController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function email_config(){

        $email = EmailConfiguration::first();
        return view('globalsetting::email_config', compact('email'));
    }

    public function update_email_config(Request $request){

        $request->validate([
            'mail_host' => 'required',
            'email' => 'required',
            'smtp_username' => 'required',
            'smtp_password' => 'required',
            'mail_port' => 'required',
            'mail_encryption' => 'required',
        ],[
            'mail_host.required' => trans('admin_validation.Mail host is required'),
            'email.required' => trans('admin_validation.Email is required'),
            'smtp_username.required' => trans('admin_validation.Smtp username is required'),
            'smtp_password.unique' => trans('admin_validation.Smtp password is required'),
            'mail_port.required' => trans('admin_validation.Mail port is required'),
            'mail_encryption.required' => trans('admin_validation.Mail encryption is required'),
        ]);

        $email = EmailConfiguration::first();
        $email->mail_host = $request->mail_host;
        $email->email = $request->email;
        $email->smtp_username = $request->smtp_username;
        $email->smtp_password = $request->smtp_password;
        $email->mail_port = $request->mail_port;
        $email->mail_encryption = $request->mail_encryption;
        $email->save();

        $notification=  trans('admin_validation.Update Successfully');
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }

    public function email_template(){
        $templates = EmailTemplate::all();
        return view('globalsetting::email_template', compact('templates'));
    }

    public function edit_email_template($id){

        $template = EmailTemplate::find($id);
        if($template){
            return view('globalsetting::edit_email_template', compact('template'));
        }else{
            $notification= trans('admin_validation.Something went wrong');
            $notification=array('messege'=>$notification,'alert-type'=>'error');
            return redirect()->route('admin.email-template')->with($notification);
        }

    }


    public function update_email_template(Request $request, $id){

        $rules = [
            'subject'=>'required',
            'description'=>'required',
        ];
        $customMessages = [
            'subject.required' => trans('admin_validation.Subject is required'),
            'description.required' => trans('admin_validation.Description is required'),
        ];

        $request->validate($rules,$customMessages);

        $template = EmailTemplate::find($id);
        if($template){
            $template->subject = $request->subject;
            $template->description = $request->description;
            $template->save();
            $notification= trans('admin_validation.Updated Successfully');
            $notification=array('messege'=>$notification,'alert-type'=>'success');
            return redirect()->route('admin.email-template')->with($notification);
        }else{
            $notification= trans('admin_validation.Something went wrong');
            $notification=array('messege'=>$notification,'alert-type'=>'error');
            return redirect()->route('admin.email-template')->with($notification);
        }
    }


}
