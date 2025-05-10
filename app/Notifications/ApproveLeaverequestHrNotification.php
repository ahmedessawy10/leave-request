<?php

namespace App\Notifications;

use App\Models\LeaveRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ApproveLeaverequestHrNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(private LeaveRequest $leaveRequest)
    {
        //
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
            ->line($this->leaveRequest->manager->name . ' is approve leave request from ' . $this->leaveRequest->user->name . ' from ' . $this->leaveRequest->start_date . ' to ' . $this->leaveRequest->end_date)
            ->action('see request', url('/'))
            ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            "message" => $this->leaveRequest->manager->name . ' is approve leave request from ' . $this->leaveRequest->user->name . ' from ' . $this->leaveRequest->start_date . ' to ' . $this->leaveRequest->end_date,
            "url" => url('/'),
            "type" => "leave_request",
            "request_id" => $this->leaveRequest->id,
            "user_id" => $this->leaveRequest->user_id,
        ];
    }
}
