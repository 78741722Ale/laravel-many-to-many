<?php

namespace App\Mail;

use App\Models\Post; /* Questo è da aggiungere, è il modello */
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewPostCreated extends Mailable
{
    use Queueable, SerializesModels;
    public $post;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        /* Questa è la view relativa alla mail */
        return $this
        ->from('noreply@example.com')
        ->subject('A new Post was Created')
        ->view('mail.posts.created');
    }
}
