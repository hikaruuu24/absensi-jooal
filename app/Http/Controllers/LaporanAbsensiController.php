<?php

namespace App\Http\Controllers;
use App\Models\Absensi;
use App\Models\User;
use Illuminate\Http\Request;

class LaporanAbsensiController extends Controller
{
    public function index() 
    {
        $data['page_title'] = 'Laporan Absensi';
        $data['breadcumb'] = 'Laporan Absensi';
        $data['users'] = User::all();
        return view('absensi.reports.report_absensi', $data);
    }

    public function generateLaporanAbsensi(Request $request)
    {
        $datepickerSelected = $request->datepickerSelect;
        if ($datepickerSelected == 'tanggal') {
            $daterange = 'tanggal';
        } elseif ($datepickerSelected == 'bulan') {
            $daterange = 'bulan';
        } elseif ($datepickerSelected == 'tahun') {
            $daterange = 'tahun';
        } else {
            $daterange = 'tanggal';
        }

        $dateWhere = $request->date;
        $user = $request->pegawai;

        if ($daterange == 'tanggal') {
            $dateFrom = date('Y-m-d 00:00:00', strtotime($dateWhere));
            $dateTo = date('Y-m-d 23:59:59', strtotime($dateWhere));
            if ($user != null) {
                $absensi = Absensi::where('user_id', $user)->whereBetween('created_at', [$dateFrom, $dateTo])->get();
            } else {
                $absensi = Absensi::whereBetween('created_at', [$dateFrom, $dateTo])->get();
            }
        } elseif ($daterange == 'bulan') {
            $dateFrom = date('Y-m-01 00:00:00', strtotime($dateWhere));
            $dateTo = date('Y-m-t 23:59:59', strtotime($dateWhere));
            $absensi = Absensi::where('user_id', $user)->whereBetween('created_at', [$dateFrom, $dateTo])->get();
        } elseif ($daterange == 'tahun') {
            $dateFrom = date('Y-01-01 00:00:00', strtotime($dateWhere));
            $dateTo = date('Y-12-31 23:59:59', strtotime($dateWhere));
            $absensi = Absensi::where('user_id', $user)->whereBetween('created_at', [$dateFrom, $dateTo])->get();
        } else {
            $dateFrom = date('Y-m-d 00:00:00', strtotime($dateWhere));
            $dateTo = date('Y-m-d 23:59:59', strtotime($dateWhere));
            $absensi = Absensi::where('user_id', $user)->whereBetween('created_at', [$dateFrom, $dateTo])->get();
        }

        $data = [];
        foreach ($absensi as $key => $value) {
            $data[$key]['nama'] = $value->user->name;
            $data[$key]['tanggal'] = date('Y-m-d', strtotime($value->tanggal));
            $data[$key]['jam_masuk'] = date('H:i:s', strtotime($value->jam_masuk));
            $data[$key]['jam_keluar'] = date('H:i:s', strtotime($value->jam_keluar));
            $data[$key]['latitude'] = $value->latitude;
            $data[$key]['longitude'] = $value->longitude;
            $data[$key]['foto'] = $value->foto;
        }
        // returns api
        return response()->json([
            'success' => true,
            'message' => 'Berhasil mengambil data absensi',
            'data' => $data
        ], 200);
    }
}
