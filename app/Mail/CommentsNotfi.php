<?php

namespace App\Mail;

use App\Comment;
use App\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;

class CommentsNotfi extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $comment;
    public $product;
    public function __construct(Comment $comment ,Product $product)
    {
        $this->comment=$comment;
        $this->product=$product;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $user= Auth::user()->email;
        return $this->from($user)->markdown('emails.comments.notfi');
    }
}
