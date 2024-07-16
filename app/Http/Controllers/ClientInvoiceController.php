<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\ClientInvoice;
use App\Models\ClientInvoiceDetail;
use App\Models\Project;
use DB;
use Carbon\Carbon;
use PDF;

class ClientInvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clientInvoices = ClientInvoice::all();

        return view('client_invoice.list', compact('clientInvoices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clients = Client::select('id', 'full_name')->get();
        $modules = DB::table('task_modules')->select('id', 'module')->get();
        $project= Project::all();

        $clientInvoice = DB::table('client_invoices')->latest()->first();
        if(!$clientInvoice){
            $newInvoiceNo = "INV-000001";
            return view('client_invoice.create', compact('clients', 'modules', 'newInvoiceNo'));
        }

        $lastInvoiceNo = DB::table('client_invoices')->orderBy('id', 'desc')->pluck('invoice_no')->first();
        $prefix = "INV-";
        $invoice_no = preg_replace("/[^0-9\.]/", '', $lastInvoiceNo);
        $newInvoiceNo = $prefix . sprintf('%06d', $invoice_no+1);

        return view('client_invoice.create', compact('clients', 'modules', 'newInvoiceNo','project'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'client_id' => 'required',
            'from_date' => 'required',
            'to_date' => 'required',
            'discount' => 'required',
            'task_module_id' => 'required',
        ]);
        
        $status="pending";

        $clientInvoice = ClientInvoice::create([
            'invoice_no' => $request->invoice_no,
            'client_id' => $request->client_id,
            'from_date' => $request->from_date,
            'to_date' => $request->to_date,
            'notes' => $request->notes,
            'discount' => $request->discount,
            'grand_total' => $request->grand_total,
            'task_module_id' => $request->task_module_id,
            'remarks'        => $request->remarks
        ]);

        if($clientInvoice){

            foreach($request->description as $key => $value){

                $data = [
                    'client_invoice_id' => $clientInvoice->id,
                    'description' => $request->description[$key],
                    'quantity' => $request->quantity[$key],
                    'rate' => $request->rate[$key],
                    'total' => $request->total[$key],
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ];

                DB::table('client_invoice_details')->insert($data);
            }
        }

        return redirect()->back()->with('success', 'Record has been submitted');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $clientInvoice = ClientInvoice::find($id);

        $clientInvoiceDetail = clientInvoiceDetail::where('client_invoice_id',$id)->get();
        
        //  $clientInvoiceDetail = ClientInvoice::find($id)->clientInvoiceDetail;

        return view('client_invoice.show', compact('clientInvoice','clientInvoiceDetail'));
        // return $clientInvoiceDetaill;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $clientInvoice = ClientInvoice::find($id);
        $clients = Client::select('id', 'full_name')->get();

        $clientInvoiceDetail = clientInvoiceDetail::where('client_invoice_id',$id)->get();
        $modules = DB::table('task_modules')->select('id', 'module')->get();
        
        //  $clientInvoiceDetail = ClientInvoice::find($id)->clientInvoiceDetail;

        return view('client_invoice.edit', compact('clientInvoice','clientInvoiceDetail', 'modules','clients'));
        
        // return $clients;
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         $this->validate($request, [
            'client_id' => 'required',
            'from_date' => 'required',
            'to_date' => 'required',
            'discount' => 'required',
            'task_module_id' => 'required',
        ]);
        
        $status="pending";

        $clientInvoice = ClientInvoice::find($id);
            $clientInvoice->invoice_no = $request->invoice_no;
            $clientInvoice->client_id = $request->client_id;
            $clientInvoice->from_date = $request->from_date;
            $clientInvoice->to_date = $request->to_date;
            $clientInvoice->notes = $request->notes;
            $clientInvoice->discount = $request->discount;
            $clientInvoice->grand_total = $request->grand_total;
            $clientInvoice->task_module_id = $request->task_module_id;
            $clientInvoice->amount_pkr = $request->amount_pkr;
            $clientInvoice->status = $request->status;
            $clientInvoice->paid_date = Carbon::now();
           $clientInvoice->update(); 
     

        if($clientInvoice){

            foreach($request->description as $key => $value){

                $data = [
                    'client_invoice_id' => $clientInvoice->id,
                    'description' => $request->description[$key],
                    'quantity' => $request->quantity[$key],
                    'rate' => $request->rate[$key],
                    'total' => $request->total[$key],
                  
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ];

                DB::table('client_invoice_details')->where('client_invoice_id',$id)->update($data);
            }
        }

        return redirect('client_invoice.show')->with('success', 'Record has been Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $clientInvoice = ClientInvoice::find($id)->delete();

        return response()->json([
            'message' => 'Record has been deleted!',
        ]);
    }

    public function createInvoice($id)
    {
        // $clients = Client::select('id', 'full_name')->get();

        $clientFullname = Client::select('id', 'full_name')->where('id', $id)->first();

        $modules = DB::table('task_modules')->select('id', 'module')->get();

        $clientInvoice = DB::table('client_invoices')->latest()->first();
        if(!$clientInvoice){
            $newInvoiceNo = "INV-000001";
            return view('client_invoice.create', compact('clientFullname', 'modules', 'newInvoiceNo'));
        }

        $lastInvoiceNo = DB::table('client_invoices')->orderBy('id', 'desc')->pluck('invoice_no')->first();
        $prefix = "INV-";
        $invoice_no = preg_replace("/[^0-9\.]/", '', $lastInvoiceNo);
        $newInvoiceNo = $prefix . sprintf('%06d', $invoice_no+1);

        return view('client_invoice.create', compact('clientFullname', 'modules', 'newInvoiceNo'));
    }
    
    public function DownloadInvoice($id){
        
        $clientInvoice = ClientInvoice::find($id);
        $css="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css";

        $clientInvoiceDetail = clientInvoiceDetail::where('client_invoice_id',$id)->get();
        
        $pdf = PDF::loadView('client_invoice.InvoiceTemplate',compact('clientInvoice','clientInvoiceDetail','css'))->setOptions(['defaultFont' => 'sans-serif']);

        return $pdf->download('ClientInvoice.pdf');
        // return view('client_invoice.InvoiceTemplate',compact('clientInvoice','clientInvoiceDetail'));
        
    }




}
