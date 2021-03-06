<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AccountCreated extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected $user;
    protected $activation;
    public function __construct($user,$activation)
    {
        $this->user = $user;
        $this->activation = $activation;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $user = $this->user;
        $activation = $this->activation;
        return $this->view('mail.accountcreated')->with(['user' => $user,'activation' => $activation]);
    }
}
