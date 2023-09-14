<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TestModel extends Model
{
    use HasFactory;

    public function getUser($nisn, $password)
    {
        return DB::table('user_siswa as us')
            ->join('user_detail_siswa as uds', 'us.nisn', '=', 'uds.nisn')
            ->join('kelas as k', 'uds.kode_kelas', '=', 'k.kode_kelas')
            ->join('detail_materi_siswa as dms', 'us.nisn', '=', 'dms.nisn')
            ->join('materi as m', 'm.id', '=', 'dms.id_materi')
            // ->join('materi as m', 'dm.id', '=', 'm.id')
            ->join('jenis_kelamin as jk', 'uds.kode_jen_kel', '=', 'jk.id')
            ->join('detail_ortu as do', 'uds.id_ortu', '=', 'do.id')
            ->where('us.nisn', '=', "$nisn", 'and', 'us.password', '=', "$password")
            ->first();
    }

    public function update_token($nisn, $token)
    {
        return DB::table('user_siswa')
            ->where('nisn', '=', "$nisn")
            ->update(['token' => $token]);
    }
    // protected $fillable
}
