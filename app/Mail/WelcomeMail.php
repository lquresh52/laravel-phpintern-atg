<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class WelcomeMail extends Mailable
{
    use Queueable, SerializesModels;
    public $nme,$mes;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name,$message)
    {
        $this->nme = $name;
        $this->mes = $message;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $e_nme = $this->nme;
        $e_msg = $this->mes;
        return $this->view('send_email_template', compact("e_msg"))->subject($e_nme);
    }
}
