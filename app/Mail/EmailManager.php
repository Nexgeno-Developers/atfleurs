<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class EmailManager extends Mailable
{
    use Queueable, SerializesModels;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $array;

    public function __construct($array)
    {
        $this->array = $array;
    }
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        // $subject = !empty($this->array['subject']) ? $this->array['subject'] : 'Contact Form Enquiry';
        $subject = !empty($this->array['subject']) ? $this->array['subject'] : 'Form Enquiry';

        $email = $this->view($this->array['view'])
              ->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'))
              ->subject($subject);

        // $email = $this->view($this->array['view'])
        //       ->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'))
        //       ->subject($this->array['subject']);

        // $email = $this->view($this->array['view'])
        //       ->from($this->array['from'], env('MAIL_FROM_NAME'))
        //       ->subject($this->array['subject']);

        if (isset($this->array['to'])) {
            $email->to($this->array['to']);
        }

        return $email;

        // return $this->view($this->array['view'])
        //             ->to($this->array['to'], env('MAIL_FROM_NAME'))
        //             ->from($this->array['from'],['email'])
        //             ->subject($this->array['subject']);

        // return $this->view($this->array['view'])
        //             ->from($this->array['from'], env('MAIL_FROM_NAME'))
        //             ->subject($this->array['subject']);
    }
}
