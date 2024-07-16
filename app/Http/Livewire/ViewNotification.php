<?php

namespace App\Http\Livewire;

use App\Models\EmployeeNotification;
use Livewire\Component;

class ViewNotification extends Component
{
    protected $poll = 20;

    public $notifications = []; // Declare the notifications property
    public $domain_notifications = [];
    public $count = '';

    protected $listeners = ['NotificationAdded' => 'refreshNotifications'];

    public function mount()
    {

        $this->refreshNotifications();
    }
    public function refreshNotifications()
    {
        if (auth()->user()->role_id == '1') {
            $this->notifications = EmployeeNotification::where('for', 'admin')->orderBy('created_at', 'desc')->get();
            $this->count = EmployeeNotification::where('for', 'admin')->where('status', '0')->orderBy('created_at', 'desc')->count();

            $this->domain_notifications = EmployeeNotification::where('notification_id', '!=',null)->orderBy('created_at', 'desc')->get();
        } elseif (auth()->user()->role_id == '3') {
            $this->notifications = EmployeeNotification::where('for', 'lead')->where('employee_id', auth()->user()->id)->orderBy('created_at', 'desc')->get();
            $this->count = EmployeeNotification::where('for', 'lead')->where('status', '0')->orderBy('created_at', 'desc')->count();
        } elseif (auth()->user()->role_id == '4') {
            $this->notifications = EmployeeNotification::where('for', 'sale')->where('employee_id', auth()->user()->id)->orderBy('created_at', 'desc')->get();
            $this->count = EmployeeNotification::where('for', 'sale')->where('status', '0')->orderBy('created_at', 'desc')->count();
        } else {
            $this->notifications = EmployeeNotification::where('for', 'employee')->where('employee_id', auth()->user()->employee_id)->orderBy('created_at', 'desc')->get();
            $this->count = EmployeeNotification::where('for', 'employee')->where('status', '!=', '2')->orderBy('created_at', 'desc')->count();

        }
    }

    public function status()
    {
        if (auth()->user()->role_id == '2') {
            EmployeeNotification::where('employee_id', auth()->user()->employee_id)->update(['status' => 2]);
        } elseif (auth()->user()->role_id == '1') {
            EmployeeNotification::where('for', 'admin')->update(['status' => 1]);
        } else {

            EmployeeNotification::where('employee_id', auth()->user()->id)->update(['status' => 1]);
        }

        $this->refreshNotifications();
    }

    public function render()
    {
        $this->refreshNotifications();
        return view('livewire.view-notification');
    }
}
