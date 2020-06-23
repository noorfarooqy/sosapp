<?php

namespace App\Notifications\submission;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ResendSubmissionNotification extends Notification
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
            ->greeting("Hello " . $this->user->name)
            ->line("Your submission to " . env("APP_NAME") . " with the title " .   $this->submission->submission_title  . "
                    has been resent. An attachment for resend reason and comment has been uploaded.")
            ->line('Please log in to the system to check the details of your submission status')
            ->action("See the status", url("/profile/submission/view/" . $this->submission->id))
            ->line("Thank you for being part of " . env("APP_NAME"))
            ->subject(env("APP_NAME") . " - Submission resent");
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
