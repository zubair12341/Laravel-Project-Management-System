<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Payslip;
use \PDF;

class PayslipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $payslips = Payslip::all();

        return view('backend.payslip.list', compact('payslips'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $employees = DB::table('employees')->select('id', 'first_name', 'middle_name', 'last_name')->get();

        return view('backend.payslip.create', compact('employees'));
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
            'date' => 'required',
            'employee_id' => 'required',
            'basic_monthly_pay' => 'required',
            'hours_deduction' => 'required',
            'payable_amount' => 'required',
            'bonus' => 'required',
            'total' => 'required',
        ]);

        Payslip::create([
            'date' => $request->date,
            'employee_id' => $request->employee_id,
            'basic_monthly_pay' => $request->basic_monthly_pay,
            'hours_deduction' => $request->hours_deduction,
            'payable_amount' => $request->payable_amount,
            'bonus' => $request->bonus,
            'total' => $request->total,
            'payment_method' => 'bank transfer'
        ]);

        return redirect()->back()->with('success', 'Record has been saved');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $payslip = Payslip::find($id);

        return view('backend.payslip.show', compact('payslip'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $payslip = Payslip::find($id)->delete();

        return response()->json([
            'message' => 'Record has been deleted!',
        ]);
        // return redirect('payslip')->with('delete', 'Record has been deleted');
    }


    public function generatePDF($id)
    {
        $payslip = Payslip::find($id);

        $data = [
            'date' => $payslip->date,
            'employee_no' => $payslip->employee->employee_no,
            'first_name' => $payslip->employee->first_name,
            'middle_name' => $payslip->employee->middle_name,
            'last_name' => $payslip->employee->last_name,
            'mobile_no' => $payslip->employee->mobile_no,
            'cnic' => $payslip->employee->cnic,
            'email' => $payslip->employee->email,
            'basic_monthly_pay' => $payslip->basic_monthly_pay,
            'bonus' => $payslip->bonus,
            'payable_amount' => $payslip->payable_amount,
            'hours_deduction' => $payslip->hours_deduction,
            'total' => $payslip->total,
            'payment_method' => $payslip->payment_method,
        ];

        // dd($data);

        $pdf = PDF::loadView('backend.payslip.generate_pdf', $data);

        return $pdf->download('payslip.pdf');

        // return view('backend.payslip.generate_pdf', $data);
    }



}
