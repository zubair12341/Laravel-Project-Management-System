@extends('layouts.master')
@section('title', 'Invoice')
@section('page-style')
<link rel="stylesheet" href="{{asset('assets/plugins/bootstrap-select/css/bootstrap-select.css')}}"/>
<link rel="stylesheet" href="{{asset('assets/plugins/select2/select2.css')}}"/>
<link rel="stylesheet" href="{{asset('assets/plugins/summernote/dist/summernote.css')}}"/>
@stop

@section('content')
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="header">
                <h2>Add Invoice</h2>
                <ul class="header-dropdown">
                    <li class="dropdown"> <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="zmdi zmdi-more"></i> </a>
                        <ul class="dropdown-menu dropdown-menu-right">
                            <li><a href="{{url('client-invoice')}}">All Invoice</a></li>
                        </ul>
                    </li>
                    <li class="remove">
                        <a role="button" class="boxs-close"><i class="zmdi zmdi-close"></i></a>
                    </li>
                </ul>
            </div>
            <div class="body">
                <form action="{{url('client-invoice')}}" method="post">
                @csrf
                <div class="row clearfix">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Invoice No</label>
                            <input type="text" name="invoice_no" class="form-control form-control-sm" value="{{$newInvoiceNo}}" readonly>
                            @error('invoice_no')
                                <label class="error">{{$errors->first('invoice_no')}}</label>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Bill To</label>
                            @if (isset($clients))
                            <select name="client_id" id="client_id" class="form-control show-tick ms select2">
                                <option></option>
                                @foreach ($clients as $client)
                                    <option value="{{$client->id}}">{{$client->full_name}}</option>
                                @endforeach
                            </select>
                            @endif

                            @if (isset($clientFullname))
                                <p class="form-control">{{$clientFullname->full_name}}</p>
                                <input type="hidden" class="form-control form-control-sm" name="client_id" value="{{$clientFullname->id}}" />
                            @endif
                            @error('client_id')
                                <label class="error">{{$errors->first('client_id')}}</label>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label>Project</label>
                           
                            <select name="project_id" id="" class="form-control show-tick ms select2">
                                <option></option>
                                @foreach ($project as $project)
                                    <option value="{{$project->id}}">{{$project->title}}</option>
                                @endforeach
                            </select>

                        <p><b>Billing Period</b></p>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>From Date</label>
                                    <input type="date" name="from_date" class="form-control form-control-sm" value="{{old('from_date')}}">
                                    @error('from_date')
                                        <label class="error">{{$errors->first('from_date')}}</label>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>To Date</label>
                                    <input type="date" name="to_date" class="form-control form-control-sm" value="{{old('to_date')}}">
                                    @error('to_date')
                                    <label class="error">{{$errors->first('to_date')}}</label>
                                    @enderror
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-6">
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-12">
                        <table class="table">
                            <tr>
                                <th>Description and Miscellaneous Work</th>
                                <th>Hours</th>
                                <th>Rate</th>
                                <th>Total</th>
                                <!--<th>option</th>-->
                            </tr>
                            <tbody class="new-row">
                            <tr>
                                <td><input type="text" class="form-control" name="description[]" /></td>
                                <td><input type="text" class="form-control qty" onkeyup="calculate();" id="hour" name="quantity[]" /></td>
                                <td><input type="text" class="form-control rate" onkeyup="calculate();" id="rate" name="rate[]" /></td>
                                <td><input type="text" class="form-control total"  id="price" name="total[]" /></td>
                                <!--<td><button type="button" class="delete-row btn btn-default" data-toggle="tooltip" data-placement="top" title="Remove"><i class="fas fa-trash" ></i></button></td>-->
                            </tr>
                            </tbody>
                        </table>
                        <!--<button type="button" id="add" class="mt-3 btn btn-sm btn-primary">+Add</button>-->
                        <hr>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label>Notes</label>
                            <textarea type="text" name="notes" class="summernote form-control">{{old('notes')}}</textarea>
                            @error('notes')
                                <label class="error">{{$errors->first('notes')}}</label>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <table  style="float: right;">
                            <tr>
                                <td style="padding-right:140px;">Discount</td>
                                <td>
                                    <div class="form-group">
                                    <input type="text" class="form-control form-control-sm" id="discount" onkeyup="calculate();" name="discount"/>
                                    @error('discount')
                                        <label class="error">{{$errors->first('discount')}}</label>
                                    @enderror
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td><b>Grand Total</b></td>
                                <td><input type="text" class="form-control form-control-sm" id="grand_total" name="grand_total" /></td>
                            </tr>
                            
                        </table>
                    </div>
              


                    <div class="col-6">
                        <div class="form-group">
                            <label>What kind of job is this?</label>
                             <select class="form-control" name="task_module_id">
                                 @foreach ($modules as $module)
                                    <option value="{{$module->id}}">{{$module->module}}</option>
                                 @endforeach
                             </select>
                            @error('task_module_id')
                                <label class="error">{{$errors->first('task_module_id')}}</label>
                            @enderror
                        </div>
                    </div>
                
                  
                    <div class="col-6">
                        <div class="form-group">
                            <label>Remarks</label>
                             <select class="form-control" name="remarks">
                               
                                    <option value="This invoice will be paid in monthly installments">This invoice will be paid in monthly installments</option>
                                    <option value="Monthly Recurring">Monthly Recurring</option>
                                    <option value="Based on Productive Hours">Based on Productive Hours</option>
                                    <option value="One Time Invoice">One Time Invoice</option>
                             
                             </select>
                            
                        </div>
                    </div>
                      </div>
              
                <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>

@stop

@section('page-script')
<script src="{{asset('assets/plugins/summernote/dist/summernote.js')}}"></script>
<script src="{{asset('assets/plugins/select2/select2.min.js')}}"></script>
<script src="{{asset('assets/js/pages/forms/advanced-form-elements.js')}}"></script>
@stop

@push('after-scripts')
<script>
    $('#add').on('click', function(){
        var tr ='<tr>'+
                '<td><input type="text" class="form-control" name="description[]" /></td>'+
                '<td><input type="text" class="form-control qty" name="quantity[]" /></td>'+
                '<td><input type="text" class="form-control rate" name="rate[]" /></td>'+
                '<td><input type="text" class="form-control total" name="total[]" /></td>'+
                '<td><button type="button" class="delete-row btn btn-default" data-toggle="tooltip" data-placement="top" title="Remove"><i class="fas fa-trash"></i></button></td>'+
                '</tr>';

    $('.new-row').append(tr);
    });

    $('.new-row').on('click', '.delete-row', function(){
         $(this).parent().parent().remove();
         total();
    });

    function cal(){
        $('.new-row').on('.qty, .rate', 'keyup', function() {
            var tr = $(this).parent().parent();
            var qty = tr.find('.qty').val();
            var rate = tr.find('.rate').val();
            var total = qty * rate;
            tr.find('.total').val(total.toFixed(2));
            total();
        });
    }

    function total(){
         var total = 0;
         $('.total').each(function(i,e){
             grand_total += $(this).val() - 0;
         });
         $("#grand_total").val(grand_total.toFixed(2));
    }
    
     function calculate ()
    {
        let hour = $('#hour').val();
        let rate = $('#rate').val();
        var total = hour*rate;

        let discount = $('#discount').val();
        var final =total-discount;

        document.getElementById("price").value = total;
        document.getElementById("grand_total").value = final;
        console.log(total);
    }
    
     $(document).ready(function(){
          $("#client_id").on('change', function(){
               var val = $(this).val();
               
               

               $.ajax({
                    type: "post",
                    url:  "{{ url('payslip/salary') }}",
                    data : {
                        "_token" : "{{ csrf_token() }}",
                        "employee_id" : val,
                    },
                    success:function(data) {
                        var employee = JSON.parse(data);
                    $("#basic-pay").val(employee.salary);
                }
            });
          });
      });

</script>
@endpush
