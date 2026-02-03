<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewsletterMail extends Mailable
{
    use Queueable, SerializesModels;

    public $subject;
    public $content;
    public $subscriber_token;
    public $attach;
    public $videoLinks;

    /**
     * Create a new message instance.
     */
    public function __construct($subject, $content,$subscriber_token,$attach,$videoLinks)
    {
        //
        $this->subject = $subject;
        $this->content = $content;
        $this->subscriber_token=$subscriber_token;
        $this->attach = $attach;
        $this->videoLinks = $videoLinks;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->subject,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'backend.emails.newsletter',
            with: [
                'subject' => $this->subject,
                'content' => $this->content,
                'token' =>$this->subscriber_token,
                'attach' => $this->attach,
                'videoLinks'=>$this->videoLinks,
            ]
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
