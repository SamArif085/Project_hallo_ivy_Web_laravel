<?php

namespace App\Http\Controllers;

use App\Models\MateriModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MateriController extends Controller
{
    protected $model;
    public function __construct()
    {
        $this->model = new MateriModel();
        // ambil session
        $this->middleware('auth');
    }
    public function index()
    {
        $idGuru = Auth::user()->id_guru;
        $dataMateri = $this->model->getMateri($idGuru);

        // dd($dataMateri);

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
        $idGuru = Auth::user()->id_guru;
        $dataMateri = $this->model->getMateri($idGuru);

        // dd($dataMateri);

        $modal = [
            'materi' => 'Tambah Materi',
            'quiz' => 'Tambah Quiz',
        ];

        $data = [
            'title' => 'Detail Materi',
            'cardTitle' => 'Detail Materi',
            'modalTitle' => $modal,
            'materi' => $dataMateri,
        ];
        return view('content/detailData', $data);
    }
}
