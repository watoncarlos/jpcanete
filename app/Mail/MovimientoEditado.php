<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class MovimientoEditado extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct($movimiento, $empresa, $centro)
    {
        $this->movimiento = $movimiento;
        $this->empresa = $empresa;
        $this->centro = $centro;
    }


    public function build()
    {
        return $this->view('emails.movimiento_editado');
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Se ha editado un Movimiento',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.movimiento_editado',
            with: [
                'movimiento' => $this->movimiento,
                'movimiento_det' => $this->movimiento_det,
                'empresa' => $this->empresa,
                'centro' => $this->centro
            ]  // Pasa la variable al contenido
        );
    }


    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
