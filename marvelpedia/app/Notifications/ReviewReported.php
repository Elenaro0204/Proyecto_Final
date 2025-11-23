<?php

namespace App\Notifications;

use App\Models\Review;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ReviewReported extends Notification
{
    use Queueable;

    protected $review;
    protected $deadline;

    /**
     * Create a new notification instance.
     */
    public function __construct($review, $deadline)
    {
        $this->review = $review;
        $this->deadline = $deadline;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via($notifiable)
    {
        return ['database']; // también puedes enviar email
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->line('The introduction to the notification.')
            ->action('Notification Action', url('/'))
            ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray($notifiable)
    {
        return [
            'review_id' => $this->review->id,
            'message' => 'Tu reseña ha sido reportada. Tienes hasta ' . $this->deadline->format('d/m/Y H:i') . ' para modificarla.',
            'deadline' => $this->deadline,
        ];
    }
}
