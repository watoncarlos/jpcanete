<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SolictudCreada extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct($solicitud, $solicitud_det , $empresa, $centro)
    {
        $this->solicitud = $solicitud;
        $this->solicitud_det = $solicitud_det;
        $this->empresa = $empresa;
        $this->centro = $centro;
    }
    
    public function build()
    {
        return $this->view('emails.solicitud_creado');
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Se ha creado una nueva Solicitud',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.solicitud_creada',
            with: [
                'solicitud' => $this->solicitud,
                'solicitud_det' => $this->solicitud_det,
                'empresa' => $this->empresa,
                'centro' => $this->centro
            ] // Pasa la variable al contenido
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
