<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $idGuru = Auth::user()->id_guru;
        $kodeKelas = DB::table('data_guru AS dg')
            ->join('users AS u', 'u.id_guru', '=', 'dg.id')
            ->select('dg.kode_kelas')
            ->where('dg.id', '=', $idGuru)
            ->get();

        $countGuru = DB::table('data_guru AS dg')
            ->where('dg.kode_kelas', '=', $kodeKelas[0]->kode_kelas)
            ->count();

        $countSiswa = DB::table('user_detail_siswa AS uds')
            ->where('uds.kode_kelas', '=', $kodeKelas[0]->kode_kelas)
            ->count();

        $countMateri = DB::table('detail_materi AS dm')
            ->where('dm.kode_kelas', '=', $kodeKelas[0]->kode_kelas)
            ->count();

        $allCount = [
            'countGuru' => $countGuru,
            'countSiswa' => $countSiswa,
            'countMateri' => $countMateri,
        ];

        $data = [
            'title' => 'Dashboard',
            'count' => $allCount,
        ];
        return view('content/dashboard', $data);
    }
}
