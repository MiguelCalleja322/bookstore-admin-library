<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BookRequestStatusMail extends Mailable
{
    use Queueable, SerializesModels;

    public $bookRequest;
    public $user;

    public function __construct($bookRequest, $user)
    {
        $this->bookRequest = $bookRequest;
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
        ->subject('About your book request')
        ->view('Mails.book_request_status');
    }
}
