@extends('layouts.master')
@section('title', 'Projects')
@section('page-style')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.css">
    <link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap-select/css/bootstrap-select.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/plugins/summernote/dist/summernote.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2/select2.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">


    <link rel="stylesheet"
        href="{{ asset('assets/plugins/ssi-uploader/dist/ssi-uploader/styles/ssi-uploader.min.css') }}" />
@stop
@section('content')
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

        .modal .modal-header .close {
            font-size: 40px;
            color: black;
            margin: -35px;
        }

        .modal-content .modal-header {
            padding-bottom: 10px;
        }

        .modal-content {
            margin-left: 30px;
        }

        #table1 td,
        th {
            border: 1px solid #bbb8b8;

            padding: 8px;
        }

        .hiddenRow {
            padding: 0 !important;
        }

        #card #body {
            background: #f0f0f0;
        }

        .accordion-toggle {

            background-color: #FFFFFF;
        }

        .accordion-toggle.red {
            background-color: #f0f0f0;
        }

        .nav-link {
            color: #67696B;
            font-weight: bold;
        }

        .nav-link.active {
            border-bottom: 2px solid blue;
        }

        .large-dropdown-menu {
            width: 70%;
            /* set the desired height */
            overflow-y: auto;
            /* add a scrollbar if the content overflows */
        }
    </style>
    <div class="row clearfix">
        <div class="col-lg-12">
            <div class="card" id="card">
                <div id="background" class="container-fluid" style="background: #1D262D;padding:20px;">
                    <div class="header-employee">

                        <div class="d-flex justify-content-center mb-5">
                            <div class="max-w-50 mt-3">
                                <h1 style="border-bottom: 1px solid white;color:white;font-weight:bold;">Project Task</h1>
                            </div>
                        </div>



                        <div class="d-flex justify-content-center mt-4">
                            <div class="w-50 ">
                                <div class="form-group mb-5">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-transparent border-0">
                                                <img src="{{ asset('img/sidebar/2.png') }}" width="25" height="25">
                                            </span>
                                        </div>
                                        <input type="text" class="form-control border-0 bg-transparent table-search"
                                            placeholder="Search: ....">
                                    </div>
                                    <hr class="border-secondary my-2">
                                </div>
                            </div>
                        </div>
                        <div style="margin-bottom:39px" class="project-info w-50 ml-3">
                          
                            <div class="dropdown show">
                                <a style="background:#1D262D;" class="btn btn-lg dropdown-toggle" href="#"
                                    role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                    <h2 style="margin-bottom: -3px;
    margin-left: -39px;">{{ $project->title }} <span><i
                                                style="font-size: 30px;" class="zmdi zmdi-chevron-right "></i></span></h2>
                                </a>

                                <div class="dropdown-menu large-dropdown-menu" aria-labelledby="dropdownMenuLink">
                                    @foreach ($projects as $project)
                                        <a class="dropdown-item border-bottom"
                                            href="{{ url('project/' . $project->id . '/task') }}">
                                            <h4 class="d-inline">{{ $project->title }}</h4>
                                            @if ($project->status == 'completed')
                                                <span class="d-inline float-right"
                                                    style="color: #6BD2AA;">{{ $project->status }}</span>
                                            @elseif($project->status == 'process')
                                                <span class="d-inline float-right"
                                                    style="color: #FAB124;">{{ $project->status }}</span>
                                            @elseif($project->status == 'pending')
                                                <span class="d-inline float-right"
                                                    style="color: #66B9C7;">{{ $project->status }}</span>
                                            @endif
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                            <h6 style="color:white;font-weight:200;"> {{ $project->employee->employee->first_name }} <span
                                    class="ml-3" style="color: #B95911;">{{ $project->status }} </span></h6>
                        </div>

                    </div>
                </div>
                <div class="body shadow-lg" id="body">
                    {{-- <ul class="nav mb-1">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#alltasks">All</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#complete">Complete</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#ongoing">Ongoing</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#workingonit">Working on it</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#stuck">Stuck</a>
                        </li>

                    </ul> --}}
                    <hr style="margin-top:-4px;">
                    <div class="tab-content">
                        <div id="alltasks" class="tab-pane fade show active">
                            <div class="table-responsive">
                                <table class="admin-datatable table table-hover mt-5 shadow" id="table1"
                                    style="width: 100%; background:white">
                                    <thead class="thead-light no-sort">
                                        <tr>
                                            <th style="background:white;"></th>
                                            <th class=" text-center " style="color:#1D262D;background:white">Task</th>

                                            <th class="text-center" style="color:#1D262D;background:white">Developer</th>
                                            <th class="text-center" style="color:#1D262D;background:white">Status</th>
                                            <th class="text-center" style="color:#1D262D;background:white">Priority</th>
                                            <th class="text-center " style="color:#1D262D;background:white">Progress</th>

                                            <th class="text-center" style="color:#1D262D;background:white">Deadline</th>
                                            <th class="text-center" style="color:#1D262D;background:white">Assign</th>
                                            <th class="text-center"
                                                style="border-right: none;color:#1D262D;width:85px;background:white">Action
                                            </th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @php
                                            $i = 0;
                                        @endphp
                                        @foreach ($project->tasks as $projectTask)
                                            <?php
                                            $referenceCount = DB::table('task_attachments')
                                                ->select(DB::raw('count(distinct attachment) as quantity'))
                                                ->where('task_id', $projectTask->id)
                                                ->first();
                                            ?>

                                            @php
                                                $i++;
                                            @endphp
                                            <tr>
                                                <td style="border-left: none;">{{ $i }}</td>
                                                <td>
                                                    {{ $projectTask->project->title ?? null }}

                                                </td>

                                                <td>
@if($projectTask->employee)
                                                    <span>{{ $projectTask->employee->first_name . ' ' . $projectTask->employee->middle_name . ' ' . $projectTask->employee->last_name ?? null }}</span>
                                                    @else
 <span class="btn btn-sm w-100" style="background:#fc1010;">Not Assign</span>
                                                    @endif



                                                </td>
                                                <td>
                                                    @if ($projectTask->status == 'ongoing')
                                                        <span style="background:#FCAB10;"
                                                            class="btn btn-sm w-100">{{ $projectTask->status }}</span>
                                                    @elseif($projectTask->status == 'completed')
                                                        <span style="background: #39C38D;"
                                                            class="btn btn-sm w-100">{{ $projectTask->status }}</span>
                                                    @elseif($projectTask->status == 'pending')
                                                        <span style="background: #BBBDC1;"
                                                            class="btn btn-sm w-100">{{ $projectTask->status }}</span>
                                                    @elseif($projectTask->status == 'working on it')
                                                        <span style="background: #FBAB10;"
                                                            class="btn btn-sm">{{ $projectTask->status }}</span>
                                                    @elseif($projectTask->status == 'in progress')
                                                        <span style="background: #BBBDC1;"
                                                            class="btn btn-sm">{{ $projectTask->status }}</span>
                                                    @endif
                                                </td>
                                                <td>


                                                    @if ($projectTask->priority == 'high')
                                                        <span style="background:#fc2b10;"
                                                            class="btn btn-sm w-100">{{ ucFirst($projectTask->priority) }}</span>
                                                    @elseif($projectTask->priority == 'normal')
                                                        <span style="background: #39C38D;"
                                                            class="btn btn-sm w-100">{{ ucFirst($projectTask->priority) }}</span>
                                                    @elseif($projectTask->priority == 'medium')
                                                        <span style="background: #df9b09;"
                                                            class="btn btn-sm w-100">{{ ucFirst($projectTask->priority) }}</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <span style="background: #272c77;"
                                                        class="btn btn-sm w-100">{{ ucFirst($projectTask->progress) }}%</span>
                                                </td>


                                                <td>
                                                    {{ $projectTask->deadline_date ? \Carbon\Carbon::parse($projectTask->deadline_date)->format('j F, Y') : null }}
                                                </td>
                                                <td>
                                                    {{ $projectTask->assign_date ? \Carbon\Carbon::parse($projectTask->assign_date)->format('j F, Y') : null }}
                                                </td>
                                                <td style="border-right: none; ">

                                                    <a class="btn btn-success btn-sm w-100"
                                                    href="{{ route('edit.task', $projectTask->id) }}"><i class="zmdi zmdi-edit mr-1"></i> @if(auth()->user()->role_id==3) Assign  @else Edit @endif</a>
                                                <a class="btn btn-secondary btn-sm w-100"
                                                    href="{{ route('task_view', $projectTask->id) }}"><i class="zmdi zmdi-eye mr-1"></i>view</a>

                                                </td>

                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                   
                    </div>

                </div>
            </div>
        </div>
    </div>

@stop
<script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>

<script>
    $(document).ready(function() {
        $(document).on('click', '.edit-btn', function() {
            project = $(this).val();


            $.ajax({
                type: "GET",
                url: "/project/" + project + "/edit",
                success: function(response) {

                    console.log(response)
                    $('#title').val(response.project.title)
                    $('#start').val(response.project.start_date)
                    $('#end').val(response.project.end_date)
                    $('#tech').val(response.project.technology)
                    $('#web').val(response.project.website)
                    $('.radio').val(response.project.project_type)
                    $('#service').val(response.project.service)
                    $('#status').val(response.project.status)
                    $('#client').val(response.project.client_id)
                    $('#note').val(response.project.note)



                }
            })
        })
    })
</script>

@section('page-script')
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/js/all.min.js"></script>
    <script src="{{ asset('assets/js/pages/tables/jquery-datatable.js') }}"></script>
    <script src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/summernote/dist/summernote.js') }}"></script>
    <script src="{{ asset('assets/js/pages/forms/advanced-form-elements.js') }}"></script>
    <script src="{{ asset('assets/js/plupload.full.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/ssi-uploader/dist/ssi-uploader/js/ssi-uploader.min.js') }}"></script>
@stop
@push('after-scripts')
<script>
    $(document).ready(function() {
      var table = $('.table').DataTable();

      $('.table-search').on('input', function() {
        var value = $(this).val();
        table.search(value).draw();
      });
    });
  </script>
    <script>
        $('#ssi-upload').ssi_uploader({
            allowed: ['png', 'jpg', 'jpeg', 'pdf', 'txt', 'doc', 'docx', 'xls', 'csv', 'xlsx', 'pptx'],
            errorHandler: {
                method: function(msg, type) {
                    ssi_modal.notify(type, {
                        content: msg
                    });
                },
                success: 'success',
                error: 'error'
            },
            maxFileSize: 122 //mb
        });
    </script>
    <script>
        function toggleColor(element) {
            element.classList.toggle("red");
        }
    </script>
    <script>
        document.getElementById("myIcon").addEventListener("click", changeIcon);

        function changeIcon() {
            document.getElementById("icon").src = "{{ asset('img/down.png') }}";
        }
    </script>
@endpush
