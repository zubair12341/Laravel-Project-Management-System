@extends('layouts.master')
@section('title', 'payable')
@section('page-style')
<link rel="stylesheet" href="{{asset('assets/plugins/bootstrap-select/css/bootstrap-select.css')}}" />
<link rel="stylesheet" href="{{asset('assets/plugins/select2/select2.css')}}" />
@stop
@section('content')

@include('layouts.alert_message')


<style>
    #card #body {
        background: #f0f0f0;
    }

    #background {
        width: 103%;
        margin-left: -13px;
    }

    #margin {
        margin-bottom: 7rem !important;
    }

    #btn {
        background: linear-gradient(90deg, rgba(254, 148, 0, 1) 0%, rgba(255, 109, 0, 1) 100%) !important;
        color: black;
        font-weight: 900;
    }
</style>
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card" id="card">
            <div id="background" class="container-fluid" style="background: #1D262D;padding:20px;">
                <div class="header">
                    <div class="d-flex justify-content-center">
                        <div id="margin" class="max-w-50 ">
                            <h1 style="border-bottom: 1px solid white;color:white;font-weight:bold;">Add Expence</h1>
                        </div>
                    </div>
                    <ul class="header-dropdown mt-5">

                        <button id="btn" type="button" class="btn btn-primary" style="padding: inherit;margin-top: 140px;">
                            <li><a style="font-weight:700; color:white; margin-left:20px; text-decoration:none;color:black;" href="{{url('all-payable')}}">All Expence</a></li>
                            <li class="dropdown"> <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"></a>
                                <!--<ul class="dropdown-menu dropdown-menu-right">-->
                                <!--    <li><a href="{{url('employee')}}">All Employee</a></li>-->
                                <!--</ul>-->
                            </li>
                            <!--<li class="remove">-->
                            <!--    <a role="button" class="boxs-close"><i class="zmdi zmdi-close"></i></a>-->
                            <!--</li>-->
                        </button>
                    </ul>
                </div>
            </div>
            <div class="body shadow-lg" id="body">
                <p style="font-size: 20px;margin-top:-10px; color:gray;">Add Expence</p>
                <hr style="margin-top:-15px;">
                <form action="{{route('post.payable')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row clearfix shadow" style="background:white;padding-top:18px;width:100%;margin-left:1px;">
                        <div class="col-md-12">
                            <h3 style="font-weight: bold;">Basic Information</h3>
                            <hr style="margin-top:-15px;">
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Date</label>
                                <input type="date" name="date" class="form-control form-control-sm" value="{{old('date')}}">
                                @error('date')
                                <label class="error">{{$errors->first('date')}}</label>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label>Type</label>
                            <div class="form-group">
                                <select name="type" id="select-type" class="form-control form-control-sm show-tick">
                                    <option value="In" {{old('type') == 'In' ? 'selected':null}}>In

                                    </option>

                                    <option value="Out" {{old('type') == 'Out' ? 'selected':null}}>Out</option>




                                </select>

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div id="in">
                                <label>Select Project</label>
                                <select name="project_id" class="form-control form-control-sm show-tick" data-placeholder="Select">
                                    <option></option>
                                    @foreach ($projects as $project)
                                    <option value="{{$project->id}}" {{old('project_id') == $project->id ? 'selected':null}}>{{$project->title}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div id="out" style="display: none;">
                                <label>Details</label>
                                <textarea class="form-control" rows="5" name="description">{{old('notes')}}</textarea>
                            </div>

                        </div>
                        <div class="col-md-6">
                            <label>Select Account</label>
                            <select name="account" class="form-control form-control-sm show-tick" data-placeholder="Select">
                                <option></option>

                                <option value="Asad Malik - Meezan" {{old('account') == 'Asad Malik - Meezan' ? 'selected':null}}>Asad Malik - Meezan</option>
                                <option value="DA Tech - Meezan" {{old('account') == 'DA Tech - Meezan' ? 'selected':null}}>DA Tech - Meezan</option>

                            </select>

                            <div id="oo" class="mt-3" style="display: none;">
                                <label>Select Mode</label>
                                <select name="mode" class="form-control form-control-sm show-tick" data-placeholder="Select">
                                    <option></option>

                                    <option value="Online Transfer" {{old('account') == 'Online Transfer' ? 'selected':null}}>Online Transfer</option>
                                    <option value="Cash" {{old('account') == 'Cash' ? 'selected':null}}>Cash</option>
                                    <option value="Cheque" {{old('account') == 'Cheque' ? 'selected':null}}>Cheque</option>

                                </select>
                            </div>
                        </div>
                        <div id="ii" class="col-md-6 mt-3">
                            <label>Select Mode</label>
                            <select name="mode" class="form-control form-control-sm show-tick" data-placeholder="Select">
                                <option></option>

                                <option value="Online Transfer" {{old('account') == 'Online Transfer' ? 'selected':null}}>Online Transfer</option>
                                <option value="Cash" {{old('account') == 'Cash' ? 'selected':null}}>Cash</option>
                                <option value="Cheque" {{old('account') == 'Cheque' ? 'selected':null}}>Cheque</option>

                            </select>
                        </div>
                        <div class="container mt-5">
                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn btn-primary" id="save-btn">Save</button>
                            </div>
                        </div>

                    </div>






                </form>
            </div>

        </div>
        <style>
            #save-btn {
                width: 180px;
                height: 40px;
                font-size: 15px;
                background: linear-gradient(90deg, rgba(254, 148, 0, 1) 0%, rgba(255, 109, 0, 1) 100%) !important;
            }
        </style>

    </div>
</div>
</div>
<!-- <div class="header">
                <h2>Add Payable Expense </h2>
                <ul class="header-dropdown">
                     <button type="button" class="btn btn-primary" style="padding: inherit;margin: auto;">
                          <li><a style="font-weight:700; color:white; margin-left:20px; text-decoration:none;" href="{{route('all.payable')}}">All Payable Expense</a></li>
                    <li class="dropdown"> <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"></a>
                         <!--<i class="zmdi zmdi-more"></i>-->
<!--<ul class="dropdown-menu dropdown-menu-right">-->
<!--    <li><a href="{{route('all.payable')}}">All Payable Expense</a></li>-->
<!--</ul>-->
</li>
<!--<li class="remove">-->
<!--    <a role="button" class="boxs-close"><i class="zmdi zmdi-close"></i></a>-->
<!--</li>-->
</button>
</ul>
</div> -->
@stop

@push('after-scripts')
<script>
    var basic_pay = $('#basic-pay');
    var $bonus = $('#bonus');
    var pay_amount = $('#pay-amount');
    var total = $('#total');

    function calcVal() {
        var num1 = basic_pay.val();
        var num2 = $bonus.val();
        var result = parseInt(num1, 10) + parseInt(num2, 10);

        if (!isNaN(result)) {
            pay_amount.val(result);
            total.val(result);
        }
    }

    calcVal();
    basic_pay.on("keydown keyup", function() {
        calcVal();
    });
    $bonus.on("keydown keyup", function() {
        calcVal();
    });
</script>
@endpush

@section('page-script')
<script src="{{asset('assets/plugins/select2/select2.min.js')}}"></script>
<script src="{{asset('assets/js/pages/forms/advanced-form-elements.js')}}"></script>
<script src="{{asset('assets/plugins/fileuploader/jquery.fileuploader.min.js')}}"></script>
@stop

@push('after-scripts')
<script>
    $("#select-type").change(function() {
        var selectedValue = $(this).val();

        if (selectedValue == "Out") {
            $('#out').show();
            $('#in').hide();
            $('#oo').show();
            $('#ii').hide();
        } else {
            $('#in').show();
            $('#out').hide();
            $('#ii').show();
            $('#oo').hide();
        }

    });
</script>

<script>
    // enable fileuploader plugin
    $('#fileuploader').fileuploader({
        addMore: true
    });
</script>

@endpush