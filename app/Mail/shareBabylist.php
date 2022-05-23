<?php

namespace App\Mail;

use App\Models\Babylist;
use App\Models\User as ModelsUser;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class shareBabylist extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    private $babylist;
    private $user;
    private $url;

    public function __construct(Babylist $babylist, $user, $url)
    {
        // dd($babylist);
        $this->babylist = $babylist;
        $this->user = $user;
        $this->url = $url;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        return $this->subject('Er is een babylijst gedeeld')->markdown('emails.share.new', [
            'babylist' => $this->babylist,
            'user' => $this->user,
            'url' => $this->url,

        ]);
    }
}
