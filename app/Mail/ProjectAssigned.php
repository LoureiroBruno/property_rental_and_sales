<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ProjectAssigned extends Mailable
{
    use Queueable, SerializesModels;

    public function build()
    {
        return $this->subject('New Project Assignment')
            ->markdown('emails.project-assigned');
    }
}
