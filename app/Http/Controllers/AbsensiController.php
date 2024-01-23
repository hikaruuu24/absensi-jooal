<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\LaporanAktifitas;
use Illuminate\Http\Request;

class AbsensiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['page_title'] = "Absensi";
        $data['breadcumb'] = "Absensi";
        $data['absensi'] = Absensi::where('user_id', auth()->user()->id)->get();
        $data['absensi_all'] = Absensi::orderBy('id', 'desc')->get();

        $today = date('Y-m-d');
        $lastAbsensi = Absensi::where('user_id', auth()->user()->id)->whereDate('tanggal', $today)->orderBy('id', 'desc')->first();
        if ($lastAbsensi != null) {
            $data['lastAbsensi'] = $lastAbsensi;
        } else {
            $data['lastAbsensi'] = null;
        }
    
        $data['laporan_aktifitas'] = LaporanAktifitas::where('user_id', auth()->user()->id)->orderBy('id', 'desc')->get();
        $data['laporan_aktifitas_all'] = LaporanAktifitas::orderBy('id', 'desc')->get();
        


        return view('absensi.index', $data);
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
        $lastAbsensi = Absensi::where('user_id', auth()->user()->id)->whereDate('tanggal', date('Y-m-d'))->orderBy('id', 'desc')->first();
        
        try {
            if ($lastAbsensi == null) {
                $request->validate([
                    'tipe_absen' => 'required',
                    'latitude' => 'required',
                    'longitude' => 'required',
                    'foto' => 'required',
                ]);
                $absensi = new Absensi();
                $absensi->tanggal = date('Y-m-d H:i:s');
                $absensi->jam_masuk = date('H:i:s');
                $absensi->latitude = $request->latitude;
                $absensi->longitude = $request->longitude;
                $absensi->status = $request->tipe_absen;
                $absensi->user_id = auth()->user()->id;
                $absensi->tipe_absen1 = 'masuk';
                if ($request->hasFile('foto')) {
                    $image = $request->file('foto');
                    $name = time() . '.' . $image->getClientOriginalExtension();
                    $destinationPath = public_path('/images');
                    $image->move($destinationPath, $name);
                    $absensi->foto = $name;
                }
            } elseif ($lastAbsensi->jam_masuk =! null) {
                // edit last data
                $request->validate([
                    'tipe_absen' => 'required',
                ]);
                $absensi = Absensi::findOrFail($lastAbsensi->id);
                $absensi->tanggal = $absensi->tanggal;
                $absensi->jam_masuk = $absensi->jam_masuk;
                $absensi->jam_keluar = date('H:i:s');
                $absensi->latitude = $request->latitude ?? $absensi->latitude;
                $absensi->longitude = $request->longitude ?? $absensi->longitude;
                $absensi->status = $request->tipe_absen ?? $absensi->status;
                $absensi->user_id = auth()->user()->id ?? $absensi->user_id;
                $absensi->tipe_absen1 = $absensi->tipe_absen1;
                $absensi->tipe_absen2 = $request->tipe_absen;
                if ($absensi->foto == null){
                    
                    $absensi->foto = $absensi->foto;
                } else {
                    if ($request->hasFile('foto')) {
                        $image = $request->file('foto');
                        $name = time() . '.' . $image->getClientOriginalExtension();
                        $destinationPath = public_path('/images');
                        $image->move($destinationPath, $name);
                        $absensi->foto = $name;
                    }
                }
            }
            
            $absensi->save();

            return redirect()->route('absensi.index')->with('success', 'Absensi berhasil direkam');
        } catch (\Throwable $th) {
            return redirect()->route('absensi.index')->with('error', $th->getMessage());
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Absensi  $absensi
     * @return \Illuminate\Http\Response
     */
    public function show(Absensi $absensi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Absensi  $absensi
     * @return \Illuminate\Http\Response
     */
    public function edit(Absensi $absensi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Absensi  $absensi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Absensi $absensi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Absensi  $absensi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Absensi $absensi)
    {
        //
    }
}
