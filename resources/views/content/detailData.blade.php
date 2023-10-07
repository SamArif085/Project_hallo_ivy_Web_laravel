@extends('layout.mainLayout')
@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>{{ $title }}</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item">{{ $title }}</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $cardTitle }}</h5>

                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                data-bs-target="#addMateri">
                                Tambah Materi
                            </button>

                            <!-- Table with stripped rows -->
                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Jenis Tema</th>
                                        <th scope="col">Judul Materi</th>

                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr scope="row">
                                        <?php
                                            $no = 1;
                                            foreach($materi as $key => $row) {
                                        ?>
                                        <td><?= $no++ ?></td>
                                        <td><?= $row->jenis_tema ?></td>
                                        <td><?= $row->judul_materi ?></td>
                                        <td>
                                            <a href="javascript:void(0)" id="btn-edit-materi" class="btn btn-warning mb-3"
                                                data-id="{{ encrypt($row->id_materi) }}">
                                                <i class="bi bi-pencil-fill"></i></a>
                                            <a href="javascript:void(0)" id="btn-hapus-materi" class="btn btn-danger mb-3"
                                                data-id="{{ encrypt($row->id_materi) }}">
                                                <i class="bi bi-trash-fill"></i></a>
                                            <a style="text-decoration-style: none"
                                                href="{{ route('detQuiz', ['id_materi' => encrypt($row->id_materi)]) }}"
                                                class="btn btn-primary mb-3">
                                                <i class="bi bi-info-square"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                            <!-- End Table with stripped rows -->
                        </div>
                    </div>

                </div>
            </div>
        </section>

    </main><!-- End #main -->

    <!-- Kumpulan Modal -->
    @include('content.modal.modalMateri');
@endsection
