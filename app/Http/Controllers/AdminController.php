<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {

        // $kodeKelas = DB::table('data_guru AS dg')
        //     ->join('users AS u', 'u.id_guru', '=', 'dg.id')
        //     ->select('dg.kode_kelas')
        //     ->where('dg.id', '=', $idGuru)
        //     ->get();

        $countGuru = DB::table('data_guru AS dg')
            ->count();

        $countSiswa = DB::table('user_detail_siswa AS uds')
            ->count();

        $countMateri = DB::table('detail_materi AS dm')
            ->count();


        $allCount = [
            'countGuru' => $countGuru,
            'countSiswa' => $countSiswa,
            'countMateri' => $countMateri,
        ];

        $data = [
            'title' => 'Dashboard Admin',
            'cardTitle' => 'Dashboard Admin',
            'count' => $allCount,
        ];

        return view('content/dashboardAdmin', $data);
    }

    // Data Kelas
    public function dataKelas()
    {
        $kelas = DB::table('kelas')
            ->get();

        $data = [
            'title' => 'Data Kelas',
            'cardTitle' => 'Data Kelas',
            // 'modalTitle' => $modal,
            'kelas' => $kelas,
        ];
        return view('content/kelasGuru', $data);
    }

    // Data Guru
    public function dataGuru($kode_kls)
    {
        $dataGuru = DB::table('data_guru AS dg')
            ->join('users AS u', 'u.id_guru', '=', 'dg.id')
            ->join('kelas AS k', 'k.kode_kelas', '=', 'dg.kode_kelas')
            ->select('dg.id', 'dg.nama', 'dg.kode_kelas', 'u.username', 'u.password', 'k.ket_kelas')
            ->where('dg.kode_kelas', '=', decrypt($kode_kls))
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
            'kd_kls' => $kode_kls,
        ];

        return view('content/dataKelasguru', $data);
    }

    // Create Data Guru
    public function createGuru(request $request)
    {
        $data = [
            'namaGuru' => $request->namaTambahGuru,
            'kodeKelas' => decrypt($request->kodeKelasTambahGuru),
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


    // Data Siswa
    public function dataSiswa()
    {
        // $dataSiswa = DB::table('user_detail_siswa AS uds')
        //     ->join('users AS u', 'u.nisn', '=', 'uds.nisn')
        //     ->join('kelas AS k', 'k.kode_kelas', '=', 'uds.kode_kelas')
        //     ->select('uds.nisn', 'uds.nama', 'uds.kode_kelas', 'u.username', 'u.password', 'k.ket_kelas')
        //     ->get();

        $kode_kelas = DB::table('kelas AS k')
            ->get();

        $modal = [
            'tambah' => 'Tambah Data Kelas',
            'edit' => 'Ubah Data Kelas',
            'hapus' => 'Hapus Data Kelas',
            // 'detail' => 'Detail Data Siswa',
        ];

        $data = [
            'title' => 'Data Kelas',
            'cardTitle' => 'Data Kelas',
            'modal' => $modal,
            // 'dataSiswa' => $dataSiswa,
            'kodeKelas' => $kode_kelas,
        ];

        return view('content/dataKelasSiswa', $data);
    }

    // Create Kelas
    public function createKelas(request $request)
    {
        $data = [
            'imageKelas' => $request->namaTambahImageKelas,
            'kodeKelas' => $request->kodeKelasTambahKelas,
            'ketKelas' => $request->ketTambahKelas,
            'created_at' => date('Y-m-d H:i:s'),
        ];

        sleep(2);

        DB::transaction(function () use ($data) {
            DB::table('kelas')
                ->insert([
                    'image' => $data['imageKelas'],
                    'kode_kelas' => $data['kodeKelas'],
                    'ket_kelas' => $data['ketKelas'],
                    'created_at' => $data['created_at'],
                ]);
        });

        $datas = [
            'status' => 200,
            'message' => 'Data Berhasil Disimpan',
        ];

        return response()->json($datas);
    }

    // Show Data Kelas
    public function showDataKelas($kode_kelas)
    {
        $dataKelas = DB::table('kelas AS k')
            ->where('k.kode_kelas', '=', decrypt($kode_kelas))
            ->get();

        sleep(2);

        $data = [
            'imageKelas' => $dataKelas[0]->image,
            'kodeKelas' => $dataKelas[0]->kode_kelas,
            'ketKelas' => $dataKelas[0]->ket_kelas,
        ];

        return response()->json($data);
    }

    // Detail Data Siswa
    public function detailDataSiswa($kode_kelas)
    {
        $dataSiswa = DB::table('user_detail_siswa AS uds')
            ->join('kelas AS k', 'k.kode_kelas', '=', 'uds.kode_kelas')
            ->join('user_siswa AS us', 'us.nisn', '=', 'uds.nisn')
            // ->join('detail_ortu AS do', 'do.id', '=', 'uds.id_ortu')
            ->select('uds.nisn', 'uds.nama', 'uds.kode_kelas', 'us.nisn AS nisn_us', 'us.password', 'k.ket_kelas', 'uds.kode_jen_kel AS jekal')
            ->where('uds.kode_kelas', '=', decrypt($kode_kelas))
            ->orderBy('uds.nisn', 'ASC')
            ->get();

        $kodeKelas = DB::table('kelas')
            ->get();
        $ketKelas = DB::table('kelas')
            ->select('ket_kelas')
            ->where('kode_kelas', '=', decrypt($kode_kelas))
            ->get();

        // sleep(2);

        $modal = [
            'tambah' => 'Tambah Data Siswa',
            'edit' => 'Ubah Data Siswa',
            'hapus' => 'Hapus Data Siswa',
            // 'detail' => 'Detail Data Guru',
        ];

        $data = [
            'title' => 'Detail Data Siswa',
            'cardTitle' => 'Detail Data Siswa',
            'modal' => $modal,
            'dataSiswa' => $dataSiswa,
            'kd_kls' => decrypt($kode_kelas),
            'kodeKelas' => $kodeKelas,
            'ketKelas' => $ketKelas[0]->ket_kelas,
        ];

        return view('content/dataDetailSiswa', $data);
    }

    // Detail Siswa Modal
    public function detailSiswa($nisn)
    {
        $dataSiswa = DB::table('user_detail_siswa AS uds')
            ->join('kelas AS k', 'k.kode_kelas', '=', 'uds.kode_kelas')
            ->join('user_siswa AS us', 'us.nisn', '=', 'uds.nisn')
            // ->join('detail_ortu AS do', 'do.id', '=', 'uds.id_ortu')
            ->select('uds.nisn', 'uds.nama', 'uds.kode_kelas', 'us.nisn AS nisn_us', 'us.password', 'k.ket_kelas', 'uds.kode_jen_kel AS jekal')
            ->where('uds.nisn', '=', $nisn)
            ->get();

        sleep(2);

        if ($dataSiswa[0]->jekal == "P") {
            $jeKal = "PEREMPUAN";
        } else {
            $jeKal = "LAKI-LAKI";
        }

        $data = [
            'nisn' => $dataSiswa[0]->nisn,
            'nama' => $dataSiswa[0]->nama,
            // 'kodeKelas' => $dataSiswa[0]->kode_kelas,
            // 'nisn_us' => $dataSiswa[0]->nisn_us,
            // 'password' => $dataSiswa[0]->password,
            // 'ketKelas' => $dataSiswa[0]->ket_kelas,
            'jekal' => $jeKal,
        ];

        return response()->json($data);
    }

    // Tambah Siswa
    public function tambahSiswa(request $request)
    {
        $data = [
            'nisn' => $request->nisnTambah,
            'nama' => $request->namaSisTambah,
            'kodeKelas' => $request->kodeKelTamSiswa,
            'jenisKelamin' => $request->jekelSisTambah,
            'username' => $request->nisnTambah,
            'password' => sha1(md5($request->nisnTambah)),
            'created_at' => date('Y-m-d H:i:s'),
        ];

        sleep(2);

        DB::transaction(function () use ($data) {
            $idSiswa = DB::table('user_detail_siswa')->insertGetId(
                [
                    'nisn' => $data['nisn'],
                    'nama' => $data['nama'],
                    'kode_kelas' => $data['kodeKelas'],
                    'kode_jen_kel' => $data['jenisKelamin'],
                    'created_at' => $data['created_at'],
                ]
            );

            DB::table('user_siswa')
                ->insert([
                    'nisn' => $data['nisn'],
                    'password' => $data['password'],
                    'created_at' => $data['created_at'],
                ]);
        });

        $datas = [
            'status' => 200,
            'message' => 'Data Berhasil Disimpan',
        ];

        return response()->json($datas);
    }

    // Ubah Siswa
    public function ubahSiswa(request $request)
    {
        $data = [
            'nisn' => $request->nisnUbah,
            'nama' => $request->namaSisUbah,
            'kodeKelasLama' => $request->kodeKelUbahSiswaLama,
            'kodeKelasBaru' => $request->kodeKelSisUbahBaru,
            'jenisKelaminLama' => $request->jekelUbahSiswaLama,
            'jenisKelaminBaru' => $request->jekelSisTambahBaru,
            'username' => $request->nisnUbah,
            'password' => sha1(md5($request->nisnUbah)),
            'created_at' => date('Y-m-d H:i:s'),
        ];

        sleep(2);

        if ($data['jenisKelaminBaru'] === "null" || empty($data['jenisKelaminBaru'])) {
            $jeKal = $data['jenisKelaminLama'];
        } else {
            $jeKal = $data['jenisKelaminBaru'];
        };

        if ($jeKal === 'LAKI-LAKI') {
            $jeKal = 'L';
        } else {
            $jeKal = 'P';
        }

        if ($data['kodeKelasBaru'] === "null" || empty($data['kodeKelasBaru'])) {
            $kodeKelas = $data['kodeKelasLama'];
        } else {
            $kodeKelas = $data['kodeKelasBaru'];
        };

        DB::transaction(function () use ($data, $jeKal, $kodeKelas) {
            DB::table('user_detail_siswa')
                ->where('nisn', '=', $data['nisn'])
                ->update([
                    'nisn' => $data['nisn'],
                    'nama' => $data['nama'],
                    'kode_kelas' => $kodeKelas,
                    'kode_jen_kel' => $jeKal,
                    // 'updated_at' => $data['created_at'],
                ]);

            DB::table('user_siswa')
                ->where('nisn', '=', $data['nisn'])
                ->update([
                    'nisn' => $data['nisn'],
                    'password' => $data['password'],
                    // 'updated_at' => $data['created_at'],
                ]);
        });

        $datas = [
            'status' => 200,
            'message' => 'Data Berhasil Diubah',
        ];

        return response()->json($datas);
    }
}
