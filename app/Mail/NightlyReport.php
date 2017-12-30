<?php

namespace App\Mail;

use App\Theme;
use App\User;
use App\WelcomeEmailAddress;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NightlyReport extends Mailable
{
    use Queueable, SerializesModels;

    protected $newUserCount, $newThemeCount;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->newThemeCount = Theme::withTrashed()->whereDate('created_at', date('Y-m-d'))->count();
        $this->newUserCount = User::whereDate('created_at', date('Y-m-d'))->count();
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.nightlyReport', [
            'newThemeCount' => $this->newThemeCount,
	        'newUserCount' => $this->newUserCount
        ])
            ->from(env('MAIL_FROM_ADDRESS'))
            ->to(env('MAIL_TO_ADDRESS'));
    }
}
