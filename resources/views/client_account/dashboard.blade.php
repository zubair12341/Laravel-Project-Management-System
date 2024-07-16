
@extends('layouts.client_master')
@section('title', 'Profile')
@section('page-style')
<link rel="stylesheet" href="{{asset('assets/plugins/jquery-datatable/dataTables.bootstrap4.min.css')}}"/>
<link rel="stylesheet" href="{{asset('assets/plugins/light-gallery/css/lightgallery.css')}}">
<link rel="stylesheet" href="{{asset('assets/plugins/fullcalendar/fullcalendar.min.css')}}">
@stop
@section('content')

@include('layouts.alert_message')

<div class="row clearfix">
    <div class="col-lg-4 col-md-12">
        <div class="card mcard_3">
            <div class="body">
                <img src="{{asset('img/no_image.png')}}" class="rounded-circle shadow" alt="profile-image" width="200" height="200">
                <h4 class="m-t-10"></h4>
                <div class="row">
                    <div class="col-12">
                        {{-- <ul class="social-links list-unstyled">
                            <li><a title="facebook" href="javascript:void(0);"><i class="zmdi zmdi-facebook"></i></a></li>
                            <li><a title="twitter" href="javascript:void(0);"><i class="zmdi zmdi-twitter"></i></a></li>
                            <li><a title="instagram" href="javascript:void(0);"><i class="zmdi zmdi-instagram"></i></a></li>
                        </ul> --}}
                        <h5>{{$client->full_name}}</h5>
                        {{-- <p class="text-muted">{{$employee->address}}</p> --}}
                        {{-- <small class="text-muted">Email address: </small> --}}
                        <p class="text-muted">{{$client->email}}</p>
                        {{-- <hr> --}}
                        {{-- <small class="text-muted">Phone: </small> --}}
                        <p class="text-muted">{{$client->mobile_no}}</p>
                    </div>
                    {{-- <div class="col-4">
                        <small>Following</small>
                        <h5>852</h5>
                    </div>
                    <div class="col-4">
                        <small>Followers</small>
                        <h5>13k</h5>
                    </div>
                    <div class="col-4">
                        <small>Post</small>
                        <h5>234</h5>
                    </div> --}}
                </div>
            </div>
        </div>
        {{-- <div class="card">
            <div class="body">
                <small class="text-muted">Email address: </small>
                <p>{{$employee->email}}</p>
                <hr>
                <small class="text-muted">Phone: </small>
                <p>{{$employee->mobile_no}}</p>
            </div>
        </div> --}}
    </div>

    <div class="col-lg-8 col-md-12">
        <div class="card" style="margin-bottom:0;">
            <div class="row clearfix">
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="card w_data_1">
                       <div class="body">
                            <div class="w_icon green"><i class="fal fa-clock"></i></div>
                            {{-- <h4 class="mt-3">{{$totalAttendanceCurrentMonth}}</h4> --}}
                            <span class="text-muted">Total Monthly Attendance</span>
                       </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="card w_data_1">
                       <div class="body">
                            <div class="w_icon cyan"><i class="fas fa-calendar"></i></div>
                            {{-- <h4 class="mt-3">{{$leaveCount}}/14 days</h4> --}}
                            <span class="text-muted">Leaves</span>
                       </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="card w_data_1">
                       <div class="body">
                            <div class="w_icon dark"><i class="fas fa-tasks"></i></div>
                            <h4 class="mt-3"></h4>
                            <span class="text-muted">Tasks</span><br>
                            {{-- <span class="mb-0">Ongoing {{$processTaskCount}}</span><br> --}}
                            {{-- <span class="mb-0">Completed {{$completedTaskCount}}</span> --}}
                       </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="header">
        <h2>Time Tracker</h2>
    </div>
    <div class="body">
        <div class="table-responsive">
            <table class="emp-datatable table table-hover" style="width: 100%;">
                <thead class="thead-light">
                    <tr>
                        <th>Date</th>
                        <th>Check In</th>
                        <th>Check Out</th>
                        <th>Total Hours</th>
                        <th>Break Hours</th>
                        <th>Working Hours</th>
                        <th>Options</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Date</th>
                        <th>Check In</th>
                        <th>Check Out</th>
                        <th>Total Hours</th>
                        <th>Break Hours</th>
                        <th>Working Hours</th>
                        <th>Options</th>
                    </tr>
                </tfoot>
                <tbody>
                    {{-- @foreach ($employeeTimes as $employeeTime)
                    <tr>
                        <td>
                            <div style="display: flex;">
                                <a href="javascript:void(0)" onclick="showModule({{$employeeTime->id}})"class="btn btn-sm btn-default" data-toggle="tooltip" data-placement="top" title="View Break Times"><i class="far fa-eye"></i></a>
                            </div>
                        </td>
                    </tr>
                    @endforeach --}}
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- </div> --}}

@stop

@section('page-script')
<script src="{{asset('assets/plugins/light-gallery/js/lightgallery-all.min.js')}}"></script>
<script src="{{asset('assets/bundles/fullcalendarscripts.bundle.js')}}"></script>
<script src="{{asset('assets/js/pages/medias/image-gallery.js')}}"></script>
<script src="{{asset('assets/js/pages/calendar/calendar.js')}}"></script>

<script src="{{asset('assets/bundles/datatablescripts.bundle.js')}}"></script>
<script src="{{asset('assets/plugins/jquery-datatable/buttons/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('assets/plugins/jquery-datatable/buttons/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/plugins/jquery-datatable/buttons/buttons.colVis.min.js')}}"></script>
<script src="{{asset('assets/plugins/jquery-datatable/buttons/buttons.flash.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="{{asset('assets/plugins/jquery-datatable/buttons/buttons.html5.min.js')}}"></script>
<script src="{{asset('assets/plugins/jquery-datatable/buttons/buttons.print.min.js')}}"></script>
<script src="{{asset('assets/js/pages/tables/jquery-datatable.js')}}"></script>
@stop

@push('after-scripts')

<script>

</script>

@endpush
