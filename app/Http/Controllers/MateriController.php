<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MateriController extends Controller
{
    public function index()
    {
        $modal = [
            'materi' => 'Tambah Materi',
            'quiz' => 'Tambah Quiz',
        ];

        $data = [
            'title' => 'Materi',
            'cardTitle' => 'Data Materi',
            'modalTitle' => $modal,
        ];
        return view('content/materi', $data);
    }
}
