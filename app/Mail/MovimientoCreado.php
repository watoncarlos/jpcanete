<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Address;


class MovimientoCreado extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct($movimiento, $movimiento_det ,$empresa, $centro)
    {
        $this->movimiento = $movimiento;
        $this->empresa = $empresa;
        $this->centro = $centro;
        $this->movimiento_det = $movimiento_det;
    }

    public function build()
    {
        return $this->view('emails.movimiento_creado');
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Se ha creado un nuevo Movimiento',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.movimiento_creado',
            with: [
                'movimiento' => $this->movimiento,
                'movimiento_det' => $this->movimiento_det,
                'empresa' => $this->empresa,
                'centro' => $this->centro
            ] // Pasa la variable al contenido
        );
    }

    /**
     * Get the message envelope.
     */
   

    /**
     * Get the message content definition.
     */
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
