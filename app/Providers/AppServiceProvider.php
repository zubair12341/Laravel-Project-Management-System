<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use App\Models\EmployeeNotification;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
    public function markAsRead($notification)
    {
    // $notification->status = 1;
    // $notification->save();
    // return redirect()->back();
     }


    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        Paginator::useBootstrap();
      
       // view()->composer(['layouts.navbarright'], function ($view) {
    //         $employee_id =  Auth::user()->employee_id;
    //         $notifications =  EmployeeNotification::where('employee_id', $employee_id)->get();


    //         foreach($notifications as $notification)
    // {
    //     $this->markAsRead($notification);
    // }


    //         $task = Task::where(['employee_id' => $employee_id])->first();
    //         $view->with(['notifications' => $notifications,'tasks' => $task]);
    //      });

    }
}
