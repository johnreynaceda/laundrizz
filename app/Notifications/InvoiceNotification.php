<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class InvoiceNotification extends Notification
{
    use Queueable;

    public $user;
    public $reference_number;

    public $total_amount;
    /**
     * Create a new notification instance.
     */
    public function __construct($user, $reference_number, $total_amount)
    {
        $this->user = $user;
        $this->reference_number = $reference_number;
        $this->total_amount = $total_amount;

    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Your Laundry Invoice')
            ->greeting('Hello ' . $this->user . ',')
            ->line('Thank you for your order! Here is your Laundry Invoice')
            ->line('Reference Number: ' . $this->reference_number)
            ->line('Total Amount: ₱' . number_format($this->total_amount, 2))
            ->line('If you have any questions, feel free to contact us.')
            ->salutation('Best regards, ' . config('app.name'));
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
