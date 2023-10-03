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
                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addQuiz">
                                Tambah Quiz
                            </button>

                            <!-- Table with stripped rows -->
                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Pertanyaan</th>
                                        {{-- <th>Gambar</th> --}}
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr scope="row">
                                        <?php
                                            $no = 1;
                                            foreach($quiz as $key => $row) {
                                        ?>
                                        <td><?= $no++ ?></td>
                                        <td><?= $row->pertanyaan ?></td>
                                        {{-- <td><?= $row->id_quiz ?></td> --}}
                                        <td>
                                            <a href="javascript:void(0)" class="btn btn-warning" id="btn-edit-quiz"
                                                data-id="{{ encrypt($row->id_quiz) }}">
                                                <i class="bi bi-pencil-fill"></i>
                                            </a>
                                            <a href="javascript:void(0)" id="btn-hapus-quiz" class="btn btn-danger"
                                                data-id="{{ encrypt($row->id_quiz) }}">
                                                <i class="bi bi-trash-fill"></i>
                                            </a>
                                            <a href="javascript:void(0)" class="btn btn-primary" id="btn-detail-quiz"
                                                data-id="{{ encrypt($row->id_quiz) }}">
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
    @include('content.modal.modalQuiz');
@endsection
