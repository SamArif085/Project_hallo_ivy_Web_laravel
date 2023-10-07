<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function dataGuru()
    {
        $dataGuru = DB::table('data_guru AS dg')
            ->join('users AS u', 'u.id_guru', '=', 'dg.id')
            ->join('kelas AS k', 'k.kode_kelas', '=', 'dg.kode_kelas')
            ->select('dg.id', 'dg.nama', 'dg.kode_kelas', 'u.username', 'u.password', 'k.ket_kelas')
            ->get();

        $kode_kelas = DB::table('kelas AS k')
            ->get();
        // var_dump($dataGuru);
        // die;

        $modal = [
            'tambah' => 'Tambah Data Guru',
            'edit' => 'Ubah Data Guru',
            'hapus' => 'Hapus Data Guru',
            'detail' => 'Detail Data Guru',
        ];

        $data = [
            'title' => 'Data Guru',
            'cardTitle' => 'Data Guru',
            'modal' => $modal,
            'dataGuru' => $dataGuru,
            'kodeKelas' => $kode_kelas,
        ];

        return view('content/dataguru', $data);
    }

    // Create Data Guru
    public function createGuru(request $request)
    {
        $data = [
            'namaGuru' => $request->namaTambahGuru,
            'kodeKelas' => $request->kodeKelasTambahGuru,
            'jenisKelamin' => $request->jenisKelaminGuru,
            'username' => $request->usernameTambahGuru,
            'password' => Hash::make($request->passwordTambahGuru),
            'role' => 2,
            'created_at' => date('Y-m-d H:i:s'),
        ];

        sleep(2);

        DB::transaction(function () use ($data) {
            $idGuru = DB::table('data_guru')->insertGetId(
                [
                    'nama' => $data['namaGuru'],
                    'kode_kelas' => $data['kodeKelas'],
                    'jenisKelamin' => $data['jenisKelamin'],
                    'created_at' => $data['created_at'],
                    'update_at' => $data['created_at'],
                ]
            );

            DB::table('users')
                ->insert([
                    'name' => $data['namaGuru'],
                    'username' => $data['username'],
                    'password' => $data['password'],
                    'role' => $data['role'],
                    'id_guru' => $idGuru,
                    'created_at' => $data['created_at'],
                    'updated_at' => $data['created_at'],
                ]);
        });

        $datas = [
            'status' => 200,
            'message' => 'Data Berhasil Disimpan',
        ];

        return response()->json($datas);
    }

    // Detail Guru
    public function detailGuru($id_guru)
    {
        $dataGuru = DB::table('data_guru AS dg')
            ->join('users AS u', 'u.id_guru', '=', 'dg.id')
            ->join('kelas AS k', 'k.kode_kelas', '=', 'dg.kode_kelas')
            ->select('dg.id', 'dg.nama', 'dg.kode_kelas', 'u.username', 'u.password', 'k.ket_kelas', 'dg.jenisKelamin AS jeKal')
            ->where('dg.id', '=', decrypt($id_guru))
            ->get();

        sleep(2);

        if ($dataGuru[0]->jeKal == "prp") {
            $jeKal = "Perempuan";
        }
        if ($dataGuru[0]->jeKal == "lk") {
            $jeKal = "Laki-Laki";
        }
        $data = [
            'idGuru' => encrypt($dataGuru[0]->id),
            'namaGuru' => $dataGuru[0]->nama,
            'kodeKelas' => $dataGuru[0]->kode_kelas,
            'ketKelas' => $dataGuru[0]->ket_kelas,
            'jeKal' => $jeKal,
            'idJeKal' => $dataGuru[0]->jeKal,
            'username' => $dataGuru[0]->username,
            'password' => $dataGuru[0]->password,
        ];

        return response()->json($data);
    }

    // Update Data Guru
    public function updateGuru(request $request)
    {
        $data = [
            'idGuru' => decrypt($request->idUbahGuru),
            'namaGuru' => $request->namaUbahGuru,
            'kodeKelasLama' => $request->kodeKelasUbahGuruLama,
            'kodeKelasBaru' => $request->kodeKelasUbahGuruBaru,
            'jenisKelaminLama' => $request->jenisKelaUbahGuruLama,
            'jenisKelaminBaru' => $request->jenisKelaUbahGuruBaru,
            'username' => $request->usernameUbahGuru,
            'passwordLama' => $request->passwordUbahGuruLama,
            'passwordBaru' => Hash::make($request->passwordUbahGuru),
            'role' => 2,
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        sleep(2);

        if ($data['jenisKelaminBaru'] === "null") {
            $jeKal = $data['jenisKelaminLama'];
        } else {
            $jeKal = $data['jenisKelaminBaru'];
        };

        if ($data['kodeKelasBaru'] === "null") {
            $kodeKelas = $data['kodeKelasLama'];
        } else {
            $kodeKelas = $data['kodeKelasBaru'];
        };

        if ($data['passwordBaru'] === "") {
            $password = $data['passwordLama'];
        } else {
            $password = $data['passwordBaru'];
        };

        DB::transaction(function () use ($data, $jeKal, $password, $kodeKelas) {
            // var_dump($kodeKelas);
            // die;

            DB::table('data_guru')
                ->where('id', '=', $data['idGuru'])
                ->update([
                    'nama' => $data['namaGuru'],
                    'kode_kelas' => $kodeKelas,
                    'jenisKelamin' => $jeKal,
                    'update_at' => $data['updated_at'],
                ]);

            DB::table('users')
                ->where('id_guru', '=', $data['idGuru'])
                ->update([
                    'name' => $data['namaGuru'],
                    'username' => $data['username'],
                    'password' => $password,
                    'role' => $data['role'],
                    'updated_at' => $data['updated_at'],
                ]);
        });

        // var_dump($test);
        // die;

        $datas = [
            'status' => 200,
            'message' => 'Data Berhasil Diubah',
        ];

        return response()->json($datas);
    }

    // Delete Data Guru
    public function deleteGuru(request $request)
    {
        $data = [
            'idGuru' => decrypt($request->idHapusGuru),
        ];

        sleep(2);

        DB::transaction(function () use ($data) {
            DB::table('data_guru')
                ->where('id', '=', $data['idGuru'])
                ->delete();

            DB::table('users')
                ->where('id_guru', '=', $data['idGuru'])
                ->delete();
        });

        $datas = [
            'status' => 200,
            'message' => 'Data Berhasil Dihapus',
        ];

        return response()->json($datas);
    }
}
