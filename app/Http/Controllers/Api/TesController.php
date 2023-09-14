<?php

namespace App\Http\Controllers\Api;

use App\Models\TestModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;
// use App\Http\Resources\TestResource;
use Illuminate\Support\Facades\Auth;

class TesController extends Controller
{
    protected $model;
    public function __construct()
    {
        $this->model = new TestModel();
    }
    public function getUsers(Request $request)
    {
        $nisn = $request->input('nisn');
        $password = sha1(md5($request->input('password')));

        $users = $this->model->getUser($nisn, $password);
        if (!empty($users)) {
            $token = bin2hex(random_bytes(50));
            $update_token = $this->model->update_token($users->nisn, $token);
            $data = [
                'status' => true,
                'token' => $token,
                'value' => [
                    'id' => $users->id,
                    'nisn_siswa' => $users->nisn,
                    'nama' => $users->nama,
                    'kelas' => $users->ket_kelas,
                    'nama_ortu' => $users->nama_ortu,
                    'alamat_ortu' => $users->alamat,
                    'jenis_kelamin' => $users->ket_jen_kelamin,
                    'judul' => $users->judul_materi,
                    'link_materi' => $users->link_materi,
                    // 'materi_user' => $materiUs,
                ],
            ];
            return response()->json($data, 200);
        }
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
