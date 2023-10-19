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

    public function getDetail($kode_kel)
    {
        return DB::table('materi as m')
            ->select('m.id AS id_materi', 'm.jenis_tema', 'm.judul_materi', 'm.link_materi', 'm.gambar_cover', 'm.gambar_materi', 'm.created_at', 'm.update_at', 'dm.*')
            ->join('detail_materi as dm', 'dm.id_materi', '=', 'm.id')
            ->where('dm.kode_kelas', '=', "$kode_kel")
            ->orderBy('m.jenis_tema')
            ->get();
    }

    public function updateData()
    {
        $pr = DB::table('tugas_rumah')
            ->get();

        foreach ($pr as $key => $value) {
            // $data = [
            //     'date' => date('Y-m-d'),
            //     'tenggat' => $value->tenggat,
            // ];

            $date = date('Y-m-d');

            if ($value->tenggat == $date) {
                DB::table('tugas_rumah')
                    ->where('id', '=', $value->id)
                    ->update([
                        'status' => 'selesai',
                    ]);
            }
        }
    }
}
