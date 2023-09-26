<?php

namespace App\Http\Controllers\Api;

use App\Models\TestModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;
// use App\Http\Resources\TestResource;
use Illuminate\Support\Facades\Auth;

class MobileApiController extends Controller
{
    protected $model;
    public function __construct()
    {
        $this->model = new TestModel();
    }
    public function cekLogin(Request $request)
    {
        $nisn = $request->input('nisn');
        $password = sha1(md5($request->input('password')));

        $game = DB::select('SELECT * FROM data_game');

        $tugas = DB::select('SELECT * FROM tugas_rumah');

        $materiUser = DB::select("SELECT m.id, dms.nisn, m.judul_materi, m.link_materi, m.gambar_materi, m.gambar_cover, dpg.id_pesan, pg.isi_pesan, dms.count, dms.status FROM detail_materi_siswa AS dms JOIN materi AS m ON dms.id_materi = m.id JOIN detail_pesan_guru AS dpg ON m.id = dpg.id_tema JOIN pesan_guru AS pg ON pg.id = dpg.id_pesan WHERE dms.nisn = '$nisn'");

        $users = DB::select("SELECT * FROM user_siswa as us LEFT JOIN user_detail_siswa as uds ON us.nisn = uds.nisn JOIN kelas as kls on uds.kode_kelas = kls.kode_kelas JOIN detail_materi_siswa AS dms ON us.nisn = dms.nisn JOIN materi AS m ON dms.id_materi = m.id JOIN jenis_kelamin AS jk ON uds.kode_jen_kel = jk.id JOIN detail_ortu AS do ON uds.id_ortu = do.id WHERE us.nisn = '$nisn' AND us.password = '$password'");

        // $users = $this->model->getUser($nisn, $password);
        if (!empty($users)) {
            $token = bin2hex(random_bytes(20));
            $update_token = $this->model->update_token($users[0]->nisn, $token);
            $response = [
                'status' => true,
                'statusCode' => 200,
                'token' => $token,
                'value' => [
                    'id' => $users[0]->id,
                    'nisn_siswa' => $users[0]->nisn,
                    'nama' => $users[0]->nama,
                    'kelas' => $users[0]->ket_kelas,
                    'nama_ortu' => $users[0]->nama_ortu,
                    'alamat_ortu' => $users[0]->alamat,
                    'jenis_kelamin' => $users[0]->ket_jen_kelamin,
                    'judul' => $users[0]->judul_materi,
                    'link_materi' => $users[0]->link_materi,
                    'materi_user' => $materiUser,
                ],
                'link_game' => $game,
                'tugas_rumah' => $tugas,
            ];
        } else {
            $response = array(
                'status' => false,
                'statusCode' => 400,
                'message' => "Don't Find Data",
            );
        }
        // $response['statusCode']
        return response()->json($response);
    }
    public function index()
    {
        // $this->validate(
        //     $request,
        //     ['nisn' => 'required'],
        //     ['password' => 'required'],
        // );

        // $nisn = $request->input('nisn');
        // $password = sha1(md5($request->input('password')));

        $test = DB::table('user_siswa as us')
            ->join('user_detail_siswa as uds', 'us.nisn', '=', 'uds.nisn')
            ->join('kelas as k', 'uds.kode_kelas', '=', 'k.kode_kelas')
            ->join('detail_materi_siswa as dms', 'us.nisn', '=', 'dms.nisn')
            ->join('detail_materi as dm', 'dm.id', '=', 'dms.id_detail_materi')
            ->join('materi as m', 'dm.id', '=', 'm.id')
            ->join('jenis_kelamin as jk', 'uds.kode_jen_kel', '=', 'jk.id')
            ->join('detail_ortu as do', 'uds.id_ortu', '=', 'do.id');
        // ->where(['us.nisn' => $nisn, 'us.password' => $password])
        // ->first()

        // dd($test);
        // if ($test) {
        //     $data = mysqli_fetch_array($test);

        //     $token = bin2hex(random_bytes(50));
        //     $update_token = DB::update("UPDATE user_siswa SET token = '$token' WHERE id = " . $test['id']);
        // }

        return response()->json($test, 200);
    }

    // public function apiLogin(Request $request)
    // {

    //     // $data = array(
    //     //     'contoh' => 'contoh API',
    //     // );

    //     // return response()->json($data);

    //     $ambilData = $request->validate([
    //         'username' => 'required',
    //         'password' => 'required',
    //     ]);

    //     if (Auth::attempt($ambilData)) {
    //         // $request->session()->regenerate();

    //         $data = array(
    //             'status' => 'success',
    //             'message' => 'Berhasil Login',
    //             'value' => [
    //                 'id' => Auth::user()->id,
    //                 'name' => Auth::user()->name,
    //                 'username' => Auth::user()->username,
    //             ]
    //         );

    //         return response()->json($data, 200);
    //     }
    // }
}
