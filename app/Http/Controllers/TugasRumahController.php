<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TugasRumahController extends Controller
{
    public function index()
    {
        $data=[
            'title'=>'Tugas Rumah'
        ];
        return view('content/tugasRumah', $data);
    }
}
