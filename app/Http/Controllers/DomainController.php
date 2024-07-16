<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Domain;
use App\Models\EmployeeNotification;
use Carbon\Carbon;

class DomainController extends Controller
{
    public function index(Request $request)
    {
        $query = Domain::query();
        
        if ($request->has('year') && $request->input('year') && $request->has('month') && $request->input('month')) {
            $year = $request->input('year');
            $month = $request->input('month');
            
            $query->where(function ($query) use ($year, $month) {
                $query->whereYear('domain_exp_date', $year)->whereMonth('domain_exp_date', $month)
                      ->orWhereYear('website_exp_date', $year)->whereMonth('website_exp_date', $month)
                      ->orWhereYear('ssl_exp_date', $year)->whereMonth('ssl_exp_date', $month);
            });
        } elseif ($request->has('year') && $request->input('year')) {
            $year = $request->input('year');
            
            $query->where(function ($query) use ($year) {
                $query->whereYear('domain_exp_date', $year)
                      ->orWhereYear('website_exp_date', $year)
                      ->orWhereYear('ssl_exp_date', $year);
            });
        } elseif ($request->has('month') && $request->input('month')) {
            $month = $request->input('month');
            
            $query->where(function ($query) use ($month) {
                $query->whereMonth('domain_exp_date', $month)
                      ->orWhereMonth('website_exp_date', $month)
                      ->orWhereMonth('ssl_exp_date', $month);
            });
        }
    
        if ($request->has('service_provider_name') && $request->input('service_provider_name')) {
            $serviceProvider = $request->input('service_provider_name');
            $query->where('service_provider_name', $serviceProvider);
        }
    
        $domains = $query->get();
        $serviceProviders = Domain::select('service_provider_name')->distinct()->pluck('service_provider_name');
    
        return view('domain.list', [
            'domains' => $domains,
            'serviceProviders' => $serviceProviders,
        ]);
    }

    public function create()
    {
        return view('domain.create');
    }

    public function store(Request $request)
    {
       // dd($request->all());
 
        $domain = new Domain();
        $domain->domain_service_name = $request->domain_service_name;
        $domain->service_provider_name = $request->service_provider_name;
        $domain->acc_source = $request->acc_source;
        $domain->domain_exp_date = $request->domain_exp_date;
        $domain->website_status = $request->website_status;
        $domain->website_setup_date = $request->website_setup_date;
        $domain->website_exp_date = $request->website_exp_date;
        $domain->ssl_apply_date = $request->ssl_apply_date;
        $domain->ssl_exp_date = $request->ssl_exp_date;
        $domain->hosting_name = $request->hosting_name;
        $domain->domain_renewl_status = $request->domain_renewl_status;
        
        $domain->cpanel_url = $request->cpanel_url;
        $domain->username = $request->username;
        $domain->password = $request->password;

        $domain->wordpress_url = $request->wordpress_url;
        $domain->w_username = $request->w_username;
        $domain->w_password = $request->w_password;

        $domain->client_url = $request->client_url;
        $domain->c_username = $request->c_username;
        $domain->c_password = $request->c_password;
        $domain->save();

        $notification = new EmployeeNotification();
        $notification->notification_id = $domain->id;
        $notification->link = route('domain.index');
        $notification->save();

        return redirect()->back()->with('success', 'Domain has been created');
    }

    public function edit($id)
    {
        $domain = Domain::find($id);
        return view('domain.edit', ['domain' => $domain]);
    }

    public function update(Request $request)
    {
        $domain = Domain::find($request->d_id);
        $domain->domain_service_name = $request->domain_service_name;
        $domain->service_provider_name = $request->service_provider_name;
        $domain->acc_source = $request->acc_source;
        $domain->domain_exp_date = $request->domain_exp_date;
        $domain->website_status = $request->website_status;
        $domain->website_setup_date = $request->website_setup_date;
        $domain->website_exp_date = $request->website_exp_date;
        $domain->ssl_apply_date = $request->ssl_apply_date;
        $domain->ssl_exp_date = $request->ssl_exp_date;
        $domain->hosting_name = $request->hosting_name;
        $domain->domain_renewl_status = $request->domain_renewl_status;
        $domain->cpanel_url = $request->cpanel_url;
        $domain->username = $request->username;
        $domain->password = $request->password;
        $domain->wordpress_url = $request->wordpress_url;
        $domain->w_username = $request->w_username;
        $domain->w_password = $request->w_password;
        $domain->save();

        return redirect()->route('domain.index')->with('success', 'Domain has been updated');
    }
    public function delete($id)
    {
        $domain = Domain::find($id);
        $not = EmployeeNotification::where('notification_id',$id)->first();
        $not->delete();
        $domain->delete();
        return redirect()->route('domain.index')->with('success', 'Domain has been deleted');
    }
}
