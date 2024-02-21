<?php

namespace App\Http\Controllers;

use App\Models\BankAccount;
use Illuminate\Http\Request;

class BankAccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['page_title'] = 'Bank Account';
        $data['breadcumb'] = 'Bank Account';
        $lastData = BankAccount::latest()->first();
        $bankAccount = (object) array(
            'id' => isset($lastData->id) ? $lastData->id : 0,
            'nama_bank' => isset($lastData->nama_bank) ? $lastData->nama_bank : null,
            'no_rekening' => isset($lastData->no_rekening) ? $lastData->no_rekening : null,
            'atas_nama' => isset($lastData->atas_nama) ? $lastData->atas_nama : null,
        );
        $data['bank'] = $bankAccount;
        return view('sales.bank-account.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BankAccount  $bankAccount
     * @return \Illuminate\Http\Response
     */
    public function show(BankAccount $bankAccount)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BankAccount  $bankAccount
     * @return \Illuminate\Http\Response
     */
    public function edit(BankAccount $bankAccount)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BankAccount  $bankAccount
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id = 0)
    {
        if ($id == 0) {
            $bankAccount = new BankAccount;
        } else {
            $bankAccount = BankAccount::find($id);
        }

        $bankAccount->nama_bank = $request->nama_bank;
        $bankAccount->no_rekening = $request->no_rekening;
        $bankAccount->atas_nama = $request->atas_nama;
        $bankAccount->save();

        return redirect()->route('bank-account.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BankAccount  $bankAccount
     * @return \Illuminate\Http\Response
     */
    public function destroy(BankAccount $bankAccount)
    {
        //
    }
}
