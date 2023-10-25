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

        $kode_kelas = DB::table('detail_guru AS dg')
            ->where('dg.id_guru', '=', $id_guru)
            ->get();

        $kelas = DB::table('kelas AS k')
            ->join('detail_guru AS dg', 'dg.id_kel', '=', 'k.kode_kelas')
            ->where('dg.id_guru', '=', $id_guru)
            ->get();


        foreach ($kode_kelas as $row => $values) {
            $kode_kel[] = $values->id_kel;
        }

        $tugas_rumah = DB::table('tugas_rumah AS tr')
            ->whereIn('tr.kode_kelas', $kode_kel,)
            ->where('tr.status', '=', 'aktif')
            ->get();

        $history = DB::table('tugas_rumah AS tr')
            ->whereIn('tr.kode_kelas', $kode_kel)
            ->where('tr.status', '=', 'selesai')
            ->get();

        // $tugas_rumah = DB::select("select * from tugas_rumah where kode_kelas in ('$kode_kel')  and status = 'aktif'");

        // History
        // $history = DB::select("select * from tugas_rumah where kode_kelas = '$kode_kel' and status = 'selesai'");

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
            'kode_kelas' => $kelas,
        ];
        return view('content/tugasRumah', $data);
    }

    public function createDataTugasRumah(Request $request)
    {
        // $id_guru = Auth::user()->id_guru;
        // $id_kelas = DB::select("select * from data_guru where id = '$id_guru'");
        // $kode_kel = $id_kelas[0]->kode_kelas;

        $Judul = $request->judulPr;
        $deskripsi = $request->deskripsi;
        $kodeKelas = $request->kodeKelas;
        $status = $request->status;
        $tenggat = $request->tenggat;
        // $created_at = date('Y-m-d');

        sleep(2);

        DB::transaction(
            function () use ($Judul, $deskripsi, $kodeKelas, $status, $tenggat) {
                DB::table('tugas_rumah')->insert([
                    'judulPr' => $Judul,
                    'deskripsi' => $deskripsi,
                    'kode_kelas' => $kodeKelas,
                    'status' => $status,
                    'tenggat' => $tenggat,

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
            'kodeKelasLama' => $request->kodeKelasLama,
            'kodeKelasBaru' => $request->kodeKelasBaru,
        );

        if ($data['kodeKelasBaru'] == "" || $data['kodeKelasBaru'] == "null") {
            $kodeKelas = $data['kodeKelasLama'];
        } else {
            $kodeKelas = $data['kodeKelasBaru'];
        }

        // var_dump($kodeKelas);
        // die;

        sleep(2);

        DB::transaction(
            function () use ($data, $kodeKelas) {
                DB::table('tugas_rumah')
                    ->where('id', '=', $data['id'])
                    ->update([
                        'judulPr' => $data['judulPr'],
                        'deskripsi' => $data['deskripsi'],
                        'tenggat' => $data['tenggat'],
                        'status' => $data['status'],
                        'kode_kelas' => $kodeKelas,
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
        // $dataPR = DB::select("select * from tugas_rumah where id = '$idPR'");
        $dataPR = DB::table('tugas_rumah AS tr')
            ->join('kelas AS k', 'k.kode_kelas', '=', 'tr.kode_kelas')
            ->select('tr.*', 'k.ket_kelas')
            ->where('tr.id', '=', $idPR)
            ->get();

        sleep(2);

        $data = [

            'id' => base64_encode($dataPR[0]->id),
            'judulPr' => $dataPR[0]->judulPr,
            'deskripsi' => $dataPR[0]->deskripsi,
            'kode_kel' => $dataPR[0]->kode_kelas,
            'ket_kelas' => $dataPR[0]->ket_kelas,
            'tenggat' => $dataPR[0]->tenggat,
            'status' => $dataPR[0]->status,

        ];

        return response()->json($data);
    }
}
