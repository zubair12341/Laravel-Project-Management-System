<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class LoginMail extends Mailable
{
    use Queueable, SerializesModels;

    public $loginData;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($loginData)
    {
        $this->loginData = $loginData;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // return $this->view('layouts.login_mail');
        // return $this->from('ammaralam777@gmail.com')->view('layouts.login_mail')->with('loginData', $this->loginData);
        return $this->view('layouts.login_mail')->with('loginData', $this->loginData);
    }
}
