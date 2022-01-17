<?php

namespace App\Mail;

use App\EmailTemplate;
use App\Model\EmailTemplateTranslation;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Auth;

class ForgotPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct( $link)
    {

        $this->link = $link;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {


        $template = \App\EmailTemplate::where('code', 'ForgotPassword')->first();
        $message_body = $template->template;
        $replace = [
            '%link%',

        ];
        $with = [
            $this->link



        ];


        $newMessage = str_replace($replace, $with, $message_body);

        $email = 'himalayafoodmantra@gmail.com';


        return $this->from($email)
            ->subject($template->subject)
            ->view('email.mail')->with('newMessage', $newMessage);
    }
}
