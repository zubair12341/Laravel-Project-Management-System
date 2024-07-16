@extends('layouts.master')
@section('title', 'Task Tracker')
@section('page-style')
    <link rel="stylesheet" href="{{ asset('assets/plugins/jquery-datatable/dataTables.bootstrap4.min.css') }}" />
    <link rel="stylesheet"
        href="//cdn.datatables.net/plug-ins/1.10.24/features/searchHighlight/dataTables.searchHighlight.css" />

@stop

@section('content')
    @include('layouts.alert_message')
    <style>
        #btn {
            background: linear-gradient(90deg, #ceb781 0%, #7F6B3E 100%) !important;
            color: black;
            font-weight: 900;
        }

        #background {
            width: 103%;
            margin-left: -13px;
        }

        #card #body {
            background: #f0f0f0;
        }

        #table1 td,
        th {
            border: 1px solid #bbb8b8;

            padding: 8px;
        }

        .hiddenRow {
            padding: 0 !important;
        }

        .modal .modal-header .close {
            font-size: 40px;
            color: black;
            margin: -35px;
        }

        .modal-content .modal-header {
            padding-bottom: 10px;
        }

        .nav-link {
            color: #67696B;
            font-weight: bold;
        }

        .nav-link.active {
            border-bottom: 2px solid #F9BB78;
            color: #F9BB78;
        }
    </style>
    <div class="row clearfix">
        <div class="col-lg-12">
            <div class="card" id="card">

                <div id="background" class="container-fluid" style="background: #1D262D;padding:20px;">
                    <div class="header-employee">

                        <div class="d-flex justify-content-center mb-5">
                            <div class="max-w-50 mt-3">
                                <h1 style="border-bottom: 1px solid white;color:white;font-weight:bold;">All Notifications</h1>
                            </div>
                        </div>
                        <div class="container-fluid">
                            <div id="btn-row" class="row d-flex justify-content-center">
                             
                            </div>
                        </div>






                 

                    </div>
                </div>
                <div class="body shadow-lg" id="body">
                    
                    @livewire('view-notification')
                </div>
            </div>
        </div>
    </div>


@stop




@section('page-script')
    <script src="{{ asset('assets/bundles/datatablescripts.bundle.js') }}"></script>
    <script src="{{ asset('assets/plugins/jquery-datatable/buttons/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/jquery-datatable/buttons/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/jquery-datatable/buttons/buttons.colVis.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/jquery-datatable/buttons/buttons.flash.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/plug-ins/1.10.24/features/searchHighlight/dataTables.searchHighlight.min.js">
    </script>
    <script src="https://bartaz.github.io/sandbox.js/jquery.highlight.js"></script>
    <script src="{{ asset('assets/plugins/jquery-datatable/buttons/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/jquery-datatable/buttons/buttons.print.min.js') }}"></script>
    <script src="{{ asset('assets/js/pages/tables/jquery-datatable.js') }}"></script>
@stop

@push('after-scripts')
    <script>
        function viewDetails(id) {
            $.get('/task/' + id, function(task) {
                $('#id').html(task.id);
                $('#project').html(task.project_id);
                $('#employee').html(task.employee_id);
                $('#task_no').html(task.task_no);
                $('#priority').html(task.priority);
                $('#assign_date').html(task.assign_date);
                $('#deadline_date').html(task.deadline_date);
                $('#status').html(task.status);
                $('#showModal').modal('toggle');
            });
        }

        function viewProgress(id) {
            $.get('/check-view-progress/' + id, function(checkViewProgress) {
                if (checkViewProgress.title) {
                    window.location.href = "{{ url('/view-task-progress') }}" + "/" + id;
                } else {
                    alert('No task progress submit yet');
                }
            });
        }
    </script>
    <script>
        var messageLink = document.getElementById('open');
        var box = document.getElementById('box');

        messageLink.addEventListener('click', function(e) {
            e.preventDefault();
            box.style.display = 'block';
        });

        var closeButton = document.querySelector('#box .close');
        var box = document.querySelector('#box');

        closeButton.addEventListener('click', function() {
            box.style.display = 'none';
        });
    </script>

    <script>
        function open_popup() {
            document.getElementById("box").style.display = 'block';
        }
    </script>
@endpush
