<?php

namespace App\Http\Controllers;

use App\Mail\MailPM;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailPMController extends Controller
{
    public static function send(Request $request){
        $users = $request->targetMailText;
        $title = $request->titleMailText;
        $body = $request->bodyMailText;

        $emailData = [
            'title' => $title,
            'body' => $body,
        ];
        Mail::to($users)->send(new MailPM($emailData));
        dd("Mail enviado correctamente!");
    }

    public function index()
    {
        /*$emailData = [
            'title' => "Correo desde Project Manager UTA",
            'body' => "Este es el cuerpo del correo y fue enviado usando smtp"
        ];

        Mail::to('kevin.rodast.95@gmail.com')->send(new MailPM($emailData));

        dd("Email is sent successfully!");
        */
        return view('emails.index');
    }
}
