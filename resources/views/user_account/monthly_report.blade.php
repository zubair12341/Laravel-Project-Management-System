<html>
<body>
<head>
        		 <!--Datatables css -->
	<link rel="stylesheet" href="https://cdn.datatables.net/1.11.0/css/jquery.dataTables.min.css">
	<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.0.0/css/buttons.dataTables.min.css">    
</head>    
<!--    <div class="card">-->
<!--        <div class="header">-->
<!--            <h2>Time Tracker</h2>-->
<!--        </div>-->
<!--        <div class="body">-->
<!--            <div class="table-responsive">-->
<!--                <table  class="emp-datatable table table-hover" style="width: 100%;">-->
<!--                    <thead class="thead-light">-->
                      
<!--                    </thead>-->
                   
                   
<!--                </table>-->
<!--                 Modal -->
<!--                <div class="modal fade" id="viewModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">-->
<!--                    <div class="modal-dialog">-->
<!--                    <div class="modal-content">-->
<!--                        <div class="modal-header">-->
<!--                        <h5 class="modal-title" id="exampleModalLabel">Time Breaks</h5>-->
<!--                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">-->
<!--                            <span aria-hidden="true">&times;</span>-->
<!--                        </button>-->
<!--                        </div>-->
<!--                        <div class="modal-body">-->
<!--                            <table class="table">-->
<!--                                <thead>-->
<!--                                    <tr>-->
<!--                                        <th>Break Time In</th>-->
<!--                                        <th>Break Time Out</th>-->
<!--                                        <th>Total Break Time</th>-->
<!--                                    </tr>-->
<!--                                </thead>-->
<!--                                <tbody id="break-time">-->
<!--                                </tbody>-->
<!--                            </table>-->
<!--                        </div>-->
<!--                        <div class="modal-footer">-->
<!--                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--</div>-->

<!--<h1></h1>-->
<table id="example"  class="display nowrap" style="width:100%">
        <thead>
              <tr>
                          
                            <th>ID</th>
                            <th>Date</th>
                            <th>Check In</th>
                            <th>Check Out</th>
                            <th>Total Hours</th>
                            <th>Break Hours</th>
                            <th>Working Hours</th>
                        </tr>
        </thead>
        <tbody>
                        @foreach ($reports as $r)
                        <tr>
                            <th><input type="hidden" value="{{$r->id}}"></th>
                            <td>{{$r->date ? date('j F, Y', strtotime($r->date)):null}}</td>
                            <td>{{$r->checkin ? date('j F, Y | g:i a', strtotime($r->checkin)):null}}</td>
                            <td>{{$r->checkout ? date('j F, Y | g:i a', strtotime($r->checkout)):null}}</td>
                            <td>{{$r->total_hours ? $r->total_hours : null}}</td>
                            <td>{{$r->break_hours ? $r->break_hours : null}}</td>
                            <td>{{$r->working_hours ? $r->working_hours : null}}</td>
                        </tr>
                        @endforeach
                    </tbody>
        <tfoot>
                        <tr>
                           
                            <th>ID</th>
                            <th>Date</th>
                            <th>Check In</th>
                            <th>Check Out</th>
                            <th>Total Hours</th>
                            <th>Break Hours</th>
                            <th>Working Hours</th>
                        </tr>
                    </tfoot>
    </table>

         <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.0/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.0/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.0/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.0/js/buttons.print.min.js"></script>
    
    <script>
        $(document).ready(function() {
    $('#example').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    } );
} );
    </script>

</body>
</html>