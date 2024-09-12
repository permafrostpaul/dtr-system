<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\DatabaseMessage;
use Illuminate\Notifications\Notification;

class LeaveRequestNotification extends Notification
{
    use Queueable;

    protected $status;
    protected $admin; // Renamed for clarity
    protected $leaveRequest;

    /**
     * Create a new notification instance.
     *
     * @param string $status
     * @param \App\Models\User $admin
     * @param \App\Models\LeaveRequest $leaveRequest
     */
    public function __construct($status, $admin, $leaveRequest)
    {
        $this->status = $status;
        $this->admin = $admin; // This should be the User model instance of the admin
        $this->leaveRequest = $leaveRequest;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database']; // Store the notification in the database
    }

    /**
     * Get the array representation of the notification for database storage.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toDatabase($notifiable)
    {
        return [
            'message' => "Your leave request has been {$this->status} by {$this->admin->firstname} {$this->admin->lastname} on " . now()->format('F j, Y \a\t g:i A'),
            'leaveRequestId' => $this->leaveRequest->id,
            'status' => $this->status,
            'admin_name' => "{$this->admin->firstname} {$this->admin->lastname}",
            'date' => now()->toDateTimeString(),
        ];
    }
}
