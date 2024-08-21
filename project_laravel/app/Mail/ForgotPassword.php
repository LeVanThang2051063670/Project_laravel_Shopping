<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ForgotPassword extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    // Mail::to($req->email)->send(new ForgotPassword($customer));
    //cai $customer truyen vao se dua vao ham tao nay,r tu day t se truyen dc sang view emails
    // return new Content(
    // view: 'emails.forgot_password',
    // );

    public $customer;
    public $token;

    public function __construct($data, $token_data)
    {
        //
        $this->customer = $data;
        $this->token = $token_data;
        //contructer nhan du lieu o ben dong 19 ve nen customer ben do truyen ve day thanh data,
        //xong data lai gan cho customer ben nay
        //truyen cai data do gan cho customer
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Forgot Password',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.forgot-password',
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
