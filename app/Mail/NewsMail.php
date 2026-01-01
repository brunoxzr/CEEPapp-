<?php
namespace App\Mail;

use App\Models\News;
use Illuminate\Mail\Mailable;

class NewsMail extends Mailable
{
    public function __construct(public News $news) {}

    public function build()
    {
        return $this
            ->subject('📰 Nova notícia - ' . $this->news->title)
            ->view('emails.news');
    }
}
