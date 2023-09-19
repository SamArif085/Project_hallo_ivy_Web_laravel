<?php
// date_default_timezone_set('Asia/Jakarta');

namespace App\Http\Controllers;

use App\Models\MateriModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class MateriController extends Controller
{
    protected $model;
    public function __construct()
    {
        $this->model = new MateriModel();
    }

    public function index()
    {
        $idGuru = Auth::user()->id_guru;
        $dataMateri = $this->model->getMateri($idGuru);

        $modal = [
            'materi' => 'Tambah Materi',
            'quiz' => 'Tambah Quiz',
        ];

        $data = [
            'title' => 'Materi',
            'cardTitle' => 'Data Materi',
            'modalTitle' => $modal,
            'materi' => $dataMateri,
        ];
        return view('content/materi', $data);
    }

    public function detailData($kode_kel)
    {
        $dataMateri = $this->model->getDetail(decrypt($kode_kel));

        $modal = [
            'materi' => 'Tambah Materi',
            'quiz' => 'Tambah Quiz',
        ];

        $data = [
            'title' => 'Detail Materi',
            'cardTitle' => 'Detail Materi',
            'modalTitle' => $modal,
            'kodeKelas' => $kode_kel,
            'materi' => $dataMateri,
        ];
        return view('content/detailData', $data);
    }

    public function createData(Request $request)
    {
        $kode_kelas = decrypt($request->kode_kelas);
        $jenis_tema = $request->jenis_tema;
        $judul_materi = $request->judul_materi;
        $link_materi = $request->link_materi;
        $gambar_cover = $request->gambar_cover;
        $gambar_materi = $request->gambar_materi;
        $created_at = date('Y-m-d H:i:s');

        DB::transaction(
            function () use ($jenis_tema, $judul_materi, $link_materi, $gambar_cover, $gambar_materi, $created_at, $kode_kelas) {
                $table1_id = DB::table('materi')->insertGetId([
                    'jenis_tema' => $jenis_tema,
                    'judul_materi' => $judul_materi,
                    'link_materi' => $link_materi,
                    'gambar_cover' => $gambar_cover,
                    'gambar_materi' => $gambar_materi,
                    'created_at' => $created_at,
                ]);

                DB::table('detail_materi')
                    ->insert([
                        'id_materi' => $table1_id,
                        'kode_kelas' => $kode_kelas,
                    ]);

                $queryTest = DB::table('detail_materi as dm')
                    ->join('user_detail_siswa as uds', 'uds.kode_kelas', '=', 'dm.kode_kelas')
                    ->select('uds.nisn')
                    ->distinct()
                    ->where('dm.kode_kelas', '=', "$kode_kelas")
                    ->get();

                foreach ($queryTest as $key => $value) {
                    $multiData = $value->nisn;

                    DB::table('detail_materi_siswa')
                        ->insert([
                            'nisn' => $multiData,
                            'id_materi' => $table1_id,
                            'count' => 0,
                            'status' => 0,
                            'created_at' => $created_at,
                        ]);
                }
            }
        );

        session()->flash('success', 'Data berhasil ditambahkan');
        return redirect()->back();
        // return view('content/detailData' . $kode_kelas, ['showModal' => true]);
    }
}
