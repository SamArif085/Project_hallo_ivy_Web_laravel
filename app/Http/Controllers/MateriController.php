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

    // Kumpulan Function Materi
    // Data Materi Untuk Datatables
    public function index()
    {
        $idGuru = Auth::user()->id_guru;
        // $dataMateri = $this->model->getMateri($idGuru);
        $dataMateri = DB::select('select * from kelas');

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

    // Data Detail Materi Untuk Datatables
    public function detailData($kode_kel)
    {
        $dataMateri = $this->model->getDetail(decrypt($kode_kel));
        // $dataMateri = $this->model->getDetail($kode_kel);

        $modal = [
            'materi' => 'Tambah Materi',
            'quiz' => 'Tambah Quiz',
            'editMateri' => 'Ubah Materi',
            'hapusMateri' => 'Hapus Materi',
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

    // Function Tambah Data Materi
    public function createData(Request $request)
    {
        $kode_kelas = decrypt($request->kodeKelas);
        $jenis_tema = $request->jenisTemaTam;
        $judul_materi = $request->judulMatTam;
        $link_materi = $request->linkMatTam;
        $gambar_cover = $request->gamCovTam;
        $gambar_materi = $request->gamMatTam;
        $created_at = date('Y-m-d H:i:s');

        sleep(1);

        DB::transaction(
            function () use ($jenis_tema, $judul_materi, $link_materi, $gambar_cover, $gambar_materi, $created_at, $kode_kelas) {
                $table1_id = DB::table('materi')->insertGetId([
                    'jenis_tema' => $jenis_tema,
                    'judul_materi' => $judul_materi,
                    'link_materi' => $link_materi,
                    'gambar_cover' => $gambar_cover,
                    'gambar_materi' => $gambar_materi,
                    'created_at' => $created_at,
                    'update_at' => $created_at,
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

        $data = [
            'status' => 200,
            'message' => 'Data Berhasil Disimpan',
            'dataIsi' => [
                'jenis_tema' => $jenis_tema,
                'judul_materi' => $judul_materi,
            ],
        ];

        return response()->json($data);
    }

    // Function Ubah Data Materi
    public function updateData(Request $request)
    {
        $data = array(
            'id_materi' => $request->id_materi,
            'jenis_tema' => $request->jenis_tema,
            'judul_materi' => $request->judul_materi,
            'link_materi' => $request->link_materi,
            'gambar_cover' => $request->gambar_cover,
            'gambar_materi' => $request->gambar_materi,
            'update_at' => date('Y-m-d H:i:s'),
        );

        // var_dump($data);
        // die;

        sleep(2);

        DB::transaction(
            function () use ($data) {
                DB::table('materi')
                    ->where('id', '=', $data['id_materi'])
                    ->update([
                        'jenis_tema' => $data['jenis_tema'],
                        'judul_materi' => $data['judul_materi'],
                        'link_materi' => $data['link_materi'],
                        'gambar_cover' => $data['gambar_cover'],
                        'gambar_materi' => $data['gambar_materi'],
                        'update_at' => $data['update_at'],
                    ]);
            }
        );

        $datas = [
            'status' => 200,
            'message' => 'Data Berhasil Disimpan',
            'dataIsi' => [
                'jenis_tema' => $data['jenis_tema'],
                'judul_materi' => $data['judul_materi'],
            ],
        ];

        return response()->json($datas);

        // session()->flash('success', 'Data berhasil diubah');
        // return redirect()->back();
    }

    // Function Hapus Data Materi
    public function deleteData(Request $request)
    {
        $data = array(
            'kode_kelas' => decrypt($request->kode_kelas),
            'id_materi' => $request->id_materi,
            'jenis_tema' => $request->jenis_tema,
            'judul_materi' => $request->judul_materi,
            'link_materi' => $request->link_materi,
            'gambar_cover' => $request->gambar_cover,
            'gambar_materi' => $request->gambar_materi,
            'update_at' => date('Y-m-d H:i:s'),
        );

        sleep(2);

        DB::transaction(
            function () use ($data) {

                DB::table('detail_materi_siswa')
                    ->where('id_materi', '=', $data['id_materi'])
                    ->delete();

                DB::table('detail_materi')
                    ->where('id_materi', '=', $data['id_materi'])
                    ->delete();

                DB::table('materi')
                    ->where('id', '=', $data['id_materi'])
                    ->delete();
            }
        );

        $datas = [
            'status' => 200,
            'message' => 'Data Berhasil Dihapus',
            'dataIsi' => [
                'jenis_tema' => $data['jenis_tema'],
                'judul_materi' => $data['judul_materi'],
            ],
        ];

        return response()->json($datas);

        // session()->flash('success', 'Data berhasil dihapus');
        // return redirect()->back();
    }

    // Ambil Data Materi Untuk Detail Materi Isi Form Modal Ubah Dan Hapus
    public function showData($id_materi)
    {
        $materi = DB::select("select * from materi where id = '$id_materi'");

        $data = [
            'status' => 200,
            // 'message' => 'Data Berhasil Disimpan',
            'idMateri' => $materi[0]->id,
            'jenisTema' => $materi[0]->jenis_tema,
            'judulMateri' => $materi[0]->judul_materi,
            'linkMateri' => $materi[0]->link_materi,
            'gambarCover' => $materi[0]->gambar_cover,
            'gambarMateri' => $materi[0]->gambar_materi,
        ];

        return response()->json($data);
    }


    // Kumpulan Data Untuk Quiz
    // Data Detail Quiz Untuk Datatables
    public function detailQuiz($idMateri)
    {
        $dataQuiz = DB::table('quiz AS q')
            ->join('detail_quiz_materi AS dqm', 'dqm.id_quiz', '=', 'q.id')
            ->join('materi AS m', 'm.id', '=', 'dqm.id_materi')
            ->select('q.id AS id_quiz', 'q.pertanyaan', 'q.image AS image_quiz')
            ->where('m.id', '=', decrypt($idMateri))
            ->get();

        $modal = [
            'tambah' => 'Tambah Quiz',
            'edit' => 'Ubah Quiz',
            'hapus' => 'Hapus Quiz',
            'detail' => 'Detail Quiz'
        ];

        $data = [
            'title' => 'Quiz',
            'cardTitle' => 'Data Quiz',
            'modalTitle' => $modal,
            'quiz' => $dataQuiz,
        ];
        return view('content/quiz', $data);
    }

    // Ambil Data Quiz Untuk Detail Quiz Modal
    public function detailDataQuiz($idQuiz)
    {
        $dataQuiz = DB::table('quiz AS q')
            ->join('detail_quiz_materi AS dqm', 'dqm.id_quiz', '=', 'q.id')
            ->join('materi AS m', 'm.id', '=', 'dqm.id_materi')
            ->select('q.id AS id_quiz', 'q.pertanyaan', 'q.image AS image_quiz')
            ->where('q.id', '=', decrypt($idQuiz))
            ->get();

        sleep(2);

        $data = [
            'status' => 200,
            'idQuiz' => $dataQuiz[0]->id_quiz,
            'perta' => $dataQuiz[0]->pertanyaan,
            'imageQuiz' => $dataQuiz[0]->image_quiz,
        ];
        return response()->json($data);
    }

    // Function Tambah Data Quiz
    public function createDataQuiz(Request $request)
    {
        $data = [
            'soalQuiz' => $request->soalQuiz,
            'imageQuiz' => $request->imageQuiz,
            'idMateri' => $request->idMateri,
            'created_at' => date('Y-m-d H:i:s'),
        ];

        sleep(2);

        DB::transaction(
            function () use ($data) {
                $table1_id = DB::table('quiz')->insertGetId([
                    'pertanyaan' => $data['soalQuiz'],
                    'image' => $data['imageQuiz'],
                    // 'updated_at' => $data['created_at'],
                ]);

                DB::table('detail_quiz_materi')
                    ->insert([
                        'id_quiz' => $table1_id,
                        'id_materi' => $data['idMateri'],
                        'created_at' => $data['created_at'],
                    ]);
            }
        );

        $datas = [
            'status' => 200,
            'message' => 'Data Berhasil Disimpan',
            // 'dataIsi' => [
            //     'soalQuiz' => $data['soalQuiz'],
            //     'imageQuiz' => $data['imageQuiz'],
            // ],
        ];

        return response()->json($datas);
    }

    // Function Ubah Data Quiz
    public function updateDataQuiz()
    {
    }

    // Function Hapus Data Quiz
    public function deleteDataQuiz()
    {
    }

    // Ambil Data Quiz Untuk Detail Quiz Modal Ubah Dan Hapus
    public function showDataQuiz()
    {
    }
}
