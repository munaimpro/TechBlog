<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\InboxModel;
use Session;
use Mail;

class InboxController extends Controller
{
    function inbox(){
        if(Session::has('loginid') == false){
            return redirect('admin/login');
        } elseif(Session::get('loginrole') != 2){
            return redirect('admin/dashboard');
        } else{
            $inbox = InboxModel::all();
            $newinbox = InboxModel::where('status','=',0)->get();
            return view('admin.inbox', compact(['inbox','newinbox']));
        }
    }

    function removeInbox($id){
        $message = InboxModel::find($id);
        $result = $message->delete();
        
        if($result){
            return back()->with('success');
        } else{
            return back()->with('fail');
        }
    }

    function viewInbox($id){
        if(Session::has('loginid') == false){
            return redirect('admin/login');
        } elseif(Session::get('loginrole') != 2){
            return redirect('admin/dashboard');
        } else{
            $message = InboxModel::find($id);
            DB::table('tbl_message')->where('id','=',$id)->update(['status'=>1]);
            return view('admin.viewmessage', compact(['message']));
        }
    }

    function replyInbox($id){
        if(Session::has('loginid') == false){
            return redirect('admin/login');
        } elseif(Session::get('loginrole') != 2){
            return redirect('admin/dashboard');
        } else{
            $message = InboxModel::where('id','=',$id)->get('email');
            return view('admin.replymessage', compact('message'));
        }
    }

    function sendReply(Request $request){
        $request->validate([
            'fromemail' => 'required|email',
            'subject' => 'required',
            'replymessage' => 'required'
        ]);

        $mail_data = [
            'from' => $request->input('fromemail'),
            'to' => $request->input('toemail'),
            'subject' => $request->input('subject'),
            'message' => $request->input('replymessage')
        ];

        $sendmail = Mail::send('admin.mail',$mail_data, function($message) use ($mail_data){
            $message->to($mail_data['to'])
                    ->from($mail_data['from'])
                    ->subject($mail_data['subject']);
        });

        if($sendmail){
            return back()->with('success', 'Message sent');
        } else{
            return back()->with('fail', 'Something went wrong!');
        }
    }

    function sendMessage(Request $request){
        $inbox = new InboxModel();

        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'subject' => 'required',
            'message' => 'required|max:1000'
        ]);

        $inbox->name = $request->input('name');
        $inbox->email = $request->input('email');
        $inbox->phone = $request->input('phone');
        $inbox->subject = $request->input('subject');
        $inbox->message = $request->input('message');

        $result = $inbox->save();

        if($result){
            return back()->with('success', 'Message sent');
        } else{
            return back()->with('fail', 'Something went wrong!');
        }
    }


}
