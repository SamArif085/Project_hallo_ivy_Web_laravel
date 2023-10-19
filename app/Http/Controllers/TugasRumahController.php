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

        $id_kelas = DB::select("select * from data_guru where id = '$id_guru'");

        // dd((object) $id_kelas[0]->id_kel);
        $kode_kel = $id_kelas[0]->kode_kelas;
        $tugas_rumah = DB::select("select * from tugas_rumah where kode_kelas = '$kode_kel'  and status = 'aktif'");

        // History
        $history = DB::select("select * from tugas_rumah where kode_kelas = '$kode_kel' and status = 'selesai'");

        $modal = [
            'materi' => 'Tambah Materi',
            'quiz' => 'Tambah Quiz',
            'editMateri' => 'Ubah Materi',
            'hapusMateri' => 'Hapus Materi',
        ];

        $data = [
            'modalTitle' => $modal,
            'title' => 'Tugas Rumah',
            'cardTitle' => 'Data Tugas Rumah',
            'cardTitleHis' => 'History Tugas Rumah',
            'tugasRumah' => $tugas_rumah,
            'history' => $history,
        ];
        return view('content/tugasRumah', $data);
    }

    public function createDataTugasRumah(Request $request)
    {
        $id_guru = Auth::user()->id_guru;
        $id_kelas = DB::select("select * from data_guru where id = '$id_guru'");
        $kode_kel = $id_kelas[0]->kode_kelas;

        $Judul = $request->judulPr;
        $deskripsi = $request->deskripsi;
        $kodeKelas = $kode_kel;
        $status = $request->status;
        $created_at = date('Y-m-d');

        sleep(1);

        DB::transaction(
            function () use ($Judul, $deskripsi, $kodeKelas, $status, $created_at) {
                DB::table('tugas_rumah')->insert([
                    'judulPr' => $Judul,
                    'deskripsi' => $deskripsi,
                    'kode_kelas' => $kodeKelas,
                    'status' => $status,
                    'tenggat' => $created_at,

                ]);
            }
        );

        $data = [
            'status' => 200,
            'message' => 'Data Berhasil Disimpan',
        ];

        return response()->json($data);
    }

    public function updateTugasRumah(Request $request)
    {
        $data = array(
            'id' => base64_decode($request->id),
            'judulPr' => $request->judulPr,
            'deskripsi' => $request->deskripsi,
            'tenggat' => $request->tenggat,
            'status' => $request->status,
        );

        // var_dump($data['id_materi']);
        // die;

        sleep(2);

        DB::transaction(
            function () use ($data) {
                DB::table('tugas_rumah')
                    ->where('id', '=', $data['id'])
                    ->update([
                        'judulPr' => $data['judulPr'],
                        'deskripsi' => $data['deskripsi'],
                        'tenggat' => $data['tenggat'],
                        'status' => $data['status'],
                    ]);
            }
        );

        $datas = [
            'status' => 200,
            'message' => 'Data Berhasil Disimpan',
        ];

        return response()->json($datas);

        // session()->flash('success', 'Data berhasil diubah');
        // return redirect()->back();
    }

    public function deleteTugasRumah(Request $request)
    {
        $data = array(

            'id' => base64_decode($request->id),
            'judulPr' => $request->judulPr,
            'deskripsi' => $request->deskripsi,
            'kode_kelas' => $request->kodeKelas,
            'tenggat' => $request->tenggat,
            'status' => $request->status,

        );

        sleep(2);

        DB::transaction(
            function () use ($data) {

                DB::table('tugas_rumah')
                    ->where('id', '=', $data['id'])
                    ->delete();
            }
        );

        $datas = [
            'status' => 200,
            'message' => 'Data Berhasil Dihapus',
        ];

        return response()->json($datas);

        // session()->flash('success', 'Data berhasil dihapus');
        // return redirect()->back();
    }

    public function showDataPR($id)
    {
        $idPR = base64_decode($id);
        $dataPR = DB::select("select * from tugas_rumah where id = '$idPR'");

        sleep(2);

        $data = [

            'id' => base64_encode($dataPR[0]->id),
            'judulPr' => $dataPR[0]->judulPr,
            'deskripsi' => $dataPR[0]->deskripsi,
            'tenggat' => $dataPR[0]->tenggat,
            'status' => $dataPR[0]->status,

        ];

        return response()->json($data);
    }
}
