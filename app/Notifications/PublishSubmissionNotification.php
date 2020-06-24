<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PublishSubmissionNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    protected $user;
    protected $submission;
    protected $published_url;
    public function __construct($user, $submission, $published_url)
    {
        $this->user = $user;
        $this->submission = $submission;
        $this->published_url = $published_url;
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
            ->line("Congratulations. Your submission to " . env("APP_NAME") . " with the title " .   $this->submission->submission_title  . "
                    has been published. The submission url")
            ->line('Please log in to the system to check the details of your submission status')
            ->action("Click here to view your submission", url($this->published_url))
            ->line("Thank you for being part of " . env("APP_NAME"))
            ->subject(env("APP_NAME") . " - Submission published");
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
