<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LaporanAktifitas;
use App\Models\HistoryLog;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;

class LaporanAktifitasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        // $request->validate([
        //     'tanggal' => 'required',
        //     'nama_perusahaan' => 'required',
        //     'nomor_hp' => 'required',
        //     'email' => 'required',
        //     'source_hunting' => 'required',
        //     'whatsapp' => 'required',
        //     'respon' => 'required',
        // ]);

        try {
            $laporan_aktifitas = new LaporanAktifitas();
            $laporan_aktifitas->tanggal = $request->tanggal;
            $laporan_aktifitas->nama_perusahaan = $request->nama_perusahaan;
            $laporan_aktifitas->nomor_hp = $request->nomor_hp;
            $laporan_aktifitas->email = $request->email;
            $laporan_aktifitas->source_hunting = $request->source_hunting;
            $laporan_aktifitas->whatsapp = $request->whatsapp;
            $laporan_aktifitas->respon = $request->respon;
            $laporan_aktifitas->kebutuhan = $request->kebutuhan;
            $laporan_aktifitas->user_id = auth()->user()->id;
            $laporan_aktifitas->save();

            return redirect()->route('absensi.index')->with('success', 'Laporan Aktifitas berhasil ditambahkan');
        } catch (\Throwable $th) {
            return redirect()->route('absensi.index')->with('error', $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $request->validate([
            'tanggal' => 'required',
            'nama_perusahaan' => 'required',
            'nomor_hp' => 'required',
            'email' => 'required',
            'source_hunting' => 'required',
        ]);

        try {
            $laporan_aktifitas = LaporanAktifitas::findOrFail($id);
            $laporan_aktifitas->tanggal = $request->tanggal;
            $laporan_aktifitas->nama_perusahaan = $request->nama_perusahaan;
            $laporan_aktifitas->nomor_hp = $request->nomor_hp;
            $laporan_aktifitas->email = $request->email;
            $laporan_aktifitas->source_hunting = $request->source_hunting;
            $laporan_aktifitas->whatsapp = $request->whatsapp;
            $laporan_aktifitas->respon = $request->respon;
            $laporan_aktifitas->kebutuhan = $request->kebutuhan;
            $laporan_aktifitas->user_id = auth()->user()->id;
            $laporan_aktifitas->save();

            return redirect()->route('absensi.index')->with('success', 'Laporan Aktifitas berhasil diubah');
        } catch (\Throwable $th) {
            return redirect()->route('absensi.index')->with('error', $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::transaction(function () use ($id) {
            $laporan_aktifitas = LaporanAktifitas::findOrFail($id);

            $newHistoryLog = new HistoryLog();
            $newHistoryLog->datetime = date('Y-m-d H:i:s');
            $newHistoryLog->type = 'Delete Laporan Aktifitas';
            $newHistoryLog->user_id = auth()->user()->id;
            $newHistoryLog->save();

            $laporan_aktifitas->delete();
        });

        Session::flash('success', 'Laporan Aktifis berhasil dihapus!');
        return response()->json(['status' => '200']);
    }
}