<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MateriModel extends Model
{
    use HasFactory;
    protected $table = 'materi';

    public function getMateri($idGuru)
    {
        // return DB::select("SELECT DISTINCT(dm.kode_kelas) FROM detail_guru AS dg JOIN users AS u ON u.id_guru = dg.id_guru JOIN detail_materi AS dm ON dm.kode_kelas = dg.id_kel WHERE dg.id_guru = $idGuru ORDER BY dm.kode_kelas ASC")->array();
        return DB::table('detail_guru as dg')
            ->join('users as u', 'u.id_guru', '=', 'dg.id_guru')
            ->join('detail_materi as dm', 'dm.kode_kelas', '=', 'dg.id_kel')
            ->join('kelas as k', 'k.kode_kelas', '=', 'dm.kode_kelas')
            ->select('dm.kode_kelas', 'k.ket_kelas')
            ->distinct()
            ->where('dg.id_guru', '=', "$idGuru")
            ->orderBy('dm.kode_kelas')
            ->get();
    }
}
