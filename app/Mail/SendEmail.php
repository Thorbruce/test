<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendEmail extends Mailable
{
    use Queueable, SerializesModels;

    private $type;
    private $code;

    /**
     * Create a new message instance.
     */
    public function __construct($type,$code)
    {
        $this->type = $type;
        $this->code = $code;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if($this->type == RETRIEVE_PASSWORD){

            return $this->view('email.retrievePassword')->subject('找回密码')->with(['code' => $this->code]);
        }

        return $this->view('email.welcome')->subject('欢迎');
    }
}
