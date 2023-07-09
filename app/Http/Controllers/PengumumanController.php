<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PengumumanController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Pengumuman',
            'cardTitle' => 'Data Pengumuman',
        ];
        return view('content/pengumuman', $data);
    }
}
