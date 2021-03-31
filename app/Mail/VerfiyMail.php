<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class VerfiyMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected $value;
    public function __construct($value)

    {
        
       $this->value = $value;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $username  = $this->value['username'];
        $message   = $this->value['msg'];
        $user_type = $this->value['user_type'];

        return $this->from('info@mydancediary.com')
                    ->subject("My dancediary account verification")
                    ->view('mail.email_verification')
                    ->with(
                        [
                            'username'  => $username, 
                            'value'     => $message,
                            'user_type' => $user_type,
                        ]
                    );
    }
}
