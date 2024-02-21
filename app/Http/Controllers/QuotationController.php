<?php

namespace App\Http\Controllers;

use App\Models\Quotation;
use App\Models\DetailQuotation;
use App\Models\BankAccount;
use Illuminate\Support\Facades\DB;
use PDF;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class QuotationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['page_title'] = 'Quotation';
        $data['breadcumb'] = 'Quotation';
        $data['quotations'] = Quotation::orderBy('id', 'desc')->get();
        return view('sales.quotation.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['page_title'] = 'Quotation';
        $data['breadcumb'] = 'Quotation';
        return view('sales.quotation.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $quotationLenght = Quotation::count();
        $produk = $request->produk;
        $no_quotation = $this->generateQuotation($quotationLenght, $produk);
        try {
            $quotation = new Quotation();
            $quotation->no_quotation = $no_quotation;
            $quotation->customer = $request->customer;
            $quotation->alamat = $request->alamat;
            $quotation->no_telepon = $request->no_telepon;
            $quotation->email = $request->email;
            $quotation->notes = $request->notes;
            $quotation->save();
            

            // get last inserted id
            $lastInsertedId = $quotation->id;
            return redirect()->route('quotation.show', $lastInsertedId)->with('success', 'Quotation created successfully');
        } catch (\Exception $e) {
            return redirect()->route('quotation.index')->with('error', 'Quotation failed to create');
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Quotation  $quotation
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['page_title'] = 'Quotation';
        $data['breadcumb'] = 'Quotation';
        $data['quotation'] = Quotation::findOrFail($id);
        $data['detailQuotations'] = DetailQuotation::where('quotation_id', $id)->get();
        return view('sales.quotation.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Quotation  $quotation
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['page_title'] = 'Quotation';
        $data['breadcumb'] = 'Quotation';
        $data['quotation'] = Quotation::findOrFail($id);
        return view('sales.quotation.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Quotation  $quotation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Quotation $quotation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Quotation  $quotation
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::transaction(function () use ($id) {
            $quotation = Quotation::findOrFail($id);
            $quotation->delete();
        });

        Session::flash('success', 'Quotation berhasil dihapus!');
        return response()->json(['status' => '200']);
    }

    public function generateQuotation($number, $produk)
    {
        if ($number == 0) {
            $number = 1;
        } else {
            $number = $number + 1;
        }
        static $first = 100;
        $first += $number;
        $middle = date('d-m-y');
        $last = $produk;

        $quotationCode = $first . '/' . $middle . '/' . 'jooal' . '/' . $last;
        return $quotationCode;
    }

    public function detailQuotation(Request $request)
    {
        try {
            $quotation = new DetailQuotation();
            $quotation->quotation_id = $request->quotation_id;
            $quotation->item = $request->item;
            $quotation->amount = $request->amount;
            $quotation->markup = $request->markup;
            $quotation->description = $request->description;
            $quotation->save();

            return response()->json([
                'message' => 'Berhasil menambahkan item',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Gagal menambahkan item',
            ], 500);
        }
    }

    public function detailQuotationDestroy($id)
    {
        DB::transaction(function () use ($id) {
            $quotation = DetailQuotation::findOrFail($id);
            $quotation->delete();
        });

        Session::flash('success', 'Detail Quotation berhasil dihapus!');
        return response()->json(['status' => '200']);
    }

    public function generatePDF($id) {
        $quotation = Quotation::findOrFail($id);
        $bank = BankAccount::first();
        $pdf = PDF::loadView('sales.quotation.pdf', compact('quotation', 'bank'));
        $pdf->setPaper('A4', 'portrait');
        $filename = 'Quotation-' . $quotation->no_quotation . '.pdf';
        return $pdf->stream($filename);
    }
}
