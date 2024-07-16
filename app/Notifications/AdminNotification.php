<?php

namespace App\Notifications;
use App\Http\Controllers\EmployeeController;

use App\Models\Employee;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AdminNotification extends Notification
{
    use Queueable;
    public $employee;
    public $daysLeft;
    
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Employee  $employee, $daysLeft)
    {
       $this->employee = $employee;
       $this->daysLeft = $daysLeft;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toDatabase($notifiable)
    {
        return [
            'id' => $this->employee->id,
            'data' => "There are days {{$daysLeft}} left for {{$employee}}'s birthday.", 
            'user' => auth()->user()->role_id == 1,      
            ]
;
    }
    
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
