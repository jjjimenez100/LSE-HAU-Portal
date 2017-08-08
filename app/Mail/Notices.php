<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Notices extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $content, $heading, $subj;
    public function __construct($subj, $content, $heading)
    {
        $this->content = $content;
        $this->heading = $heading;
        $this->subj = $subj;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.notices')->subject($this->subj)
            ->with('content', $this->content)->with('heading', $this->heading);
    }
}
