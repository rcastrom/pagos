<?php

namespace App\Mail;


use App\Models\Correo;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EnvioPagadoMailable extends Mailable
{
    use Queueable, SerializesModels;
    public $subject="Registro de pago realizado para Escala 2022";
    public $correo;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Correo $correo)
    {
        $this->correo=$correo;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('pagos.correo');
    }
}
