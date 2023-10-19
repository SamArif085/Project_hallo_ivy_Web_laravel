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
        $kodeKelas = DB::table('detail_guru AS dg')
            // ->join('users AS u', 'u.id_guru', '=', 'dg.id_guru')
            // ->select('dg.id_kel')
            ->where('dg.id_guru', '=', $idGuru)
            ->get();
        // ->toArray();

        // var_dump($kodeKelas);
        // die;
        // dd($kodeKelas);
        // $kode_kelas = [];
        foreach ($kodeKelas as $values) {
            // dd($values);
            $kode_kelas[] = $values->id_kel;
            // dd($kode_kelas);
        }

        $countGuru = DB::table('detail_guru AS dg')
            ->whereIn('dg.id_kel', $kode_kelas)
            ->groupBy('dg.id_guru')
            // ->count();
            ->count();

        // dd($countGuru);


        $countSiswa = DB::table('user_detail_siswa AS uds')
            ->whereIn('uds.kode_kelas', $kode_kelas)
            ->count();

        $countMateri = DB::table('detail_materi AS dm')
            ->whereIn('dm.kode_kelas', $kode_kelas)
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
