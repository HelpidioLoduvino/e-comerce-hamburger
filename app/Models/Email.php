<?php

namespace App\Models;

use Illuminate\Mail\Mailable;

class Email extends Mailable
{
    public $user;

    public function __construct($user)
    {
        $this->user = $user;
    }

    public function build()
    {
        return $this->subject('Tem Um Pedido Novo')
                    ->view('emails.boas-vindas')
                    ->with(['user' => $this->user]);
    }
}
