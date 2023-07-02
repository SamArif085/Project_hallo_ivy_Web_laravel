@extends('layouts.main')

@section('content')
    <div id="content">
        <h1 id="judul">Pengumuman</h1>
        <form class="mb-3 d-flex align-items-center search-btn mt-3 ps-5">
            <img src="img/search-925-256.png" alt="" style="width: 20px; height:20px;">
            <input type="text" class="form-control border-0 ms-3" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" placeholder="Search" style="font-size: 14px">
        </form>
        <button type="button" id="btn-utama" class="btn" data-bs-toggle="modal" data-bs-target="#exampleModal" style="margin-left: 50px; margin-top:15px; width:120px">
            Tambah
        </button>
        <div class="tabel">
            <table class="table text-center">
                <thead>
                <tr>
                    <th scope="col" class="col-1">Siswa</th>
                    <th scope="col" class="col-2">Kelas</th>
                    <th scope="col" class="col-1">Action</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>Mark</td>
                    <td>Otto</td>
                    <td>
                        <button class="btn btn-warning" type="submit" data-bs-toggle="modal" data-bs-target="#exampleModal">Button</button>
                        <button class="btn btn-danger" type="submit" data-bs-toggle="modal" data-bs-target="#exampleModal">Button</button>
                    </td>
                </tr>
                <tr>
                    <td>Jacob</td>
                    <td>Thornton</td>
                    <td>
                        <button class="btn btn-warning" type="submit" data-bs-toggle="modal" data-bs-target="#exampleModal">Button</button>
                        <button class="btn btn-danger" type="submit" data-bs-toggle="modal" data-bs-target="#exampleModal">Button</button>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>

@endsection
