<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class TugasRumahController extends Controller
{
    public function index()
    {
        $id_guru = Auth::user()->id_guru;

        // $kode_kel = DB::table('detail_guru as dg')
        //     ->join('data_guru as dagu', 'dagu.id', '=', 'dg.id_guru')
        //     ->select('dg.id_kel')
        //     ->where('dg.id_guru', '=', $id_guru)
        //     ->get();

        // $id_kelas = json_encode($kode_kel);

        // dd($id_kelas);

        // $tugas_rumah = DB::table('tugas_rumah')
        //     ->where('kode_kelas', '=', "$id_kelas")
        //     ->get();

        $id_kelas = DB::select("select * from detail_guru as dg join data_guru as dagu on dagu.id = dg.id_guru where id_guru = '$id_guru'");

        // dd((object) $id_kelas[0]->id_kel);
        $kode_kel = $id_kelas[0]->id_kel;
        $tugas_rumah = DB::select("select * from tugas_rumah where kode_kelas = '$kode_kel'  and status = 'aktif'");

        // History
        $history = DB::select("select * from tugas_rumah where kode_kelas = '$kode_kel' and status = 'unaktif'");

        // dd($tugas_rumah);

        $data = [
            'title' => 'Tugas Rumah',
            'cardTitle' => 'Data Tugas Rumah',
            'cardTitleHis' => 'History Tugas Rumah',
            'tugasRumah' => $tugas_rumah,
            'history' => $history,
        ];
        return view('content/tugasRumah', $data);
    }
}
