<?php

namespace App\Notifications\submission;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\HtmlString;

class SubmissionUnderReviewNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    protected $user;
    protected $submission;
    public function __construct($user, $submission)
    {
        //
        $this->user = $user;
        $this->submission = $submission;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->greeting("Hello ".$this->user->name)
                    ->line("Your submission to ".env("APP_NAME"). " with the title ".new HtmlString("<strong>".$this->submission->submission_title."</strong>")."
                    has been sent for under review. You will receive further notification regarding this submission.")
                    ->action("See the status", url("/profile/submission/view/".$this->submission->id))
                    ->line("Thank you for being part of ".env("APP_NAME"))
                    ->subject(env("APP_NAME")." - Submission under review" );
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
