<?php

namespace App\Notifications;

use App\Models\Foro;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ForoReported extends Notification
{
    use Queueable;

    protected $foro;
    protected $deadline;

    /**
     * Create a new notification instance.
     */
    public function __construct($foro, $deadline)
    {
        $this->foro = $foro;
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
            'foro_id' => $this->foro->id,
            'message' => 'Tu foro ha sido reportado. Tienes hasta ' . $this->deadline->format('d/m/Y H:i') . ' para modificarla.',
            'deadline' => $this->deadline,
        ];
    }
}
