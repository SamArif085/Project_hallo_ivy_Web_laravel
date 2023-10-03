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
                                data-bs-target="#addPR">
                                Tambah
                            </button>

                            <!-- Table with stripped rows -->
                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Judul Tugas Rumah</th>
                                        <th scope="col">Penjelasan</th>
                                        <th scope="col">Tanggat</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr scope="row">
                                        <?php
                                            $no = 1;
                                            foreach($tugasRumah as $key => $row) {
                                        ?>
                                        <td><?= $no++ ?></td>
                                        <td><?= $row->judulPr ?></td>
                                        <td><?= $row->deskripsi ?></td>
                                        <td><?= $row->tenggat ?></td>
                                        <td><?= $row->status ?></td>
                                        <td>
                                            <a style="text-decoration-style: none"
                                                href="{{ route('detail', ['kode_kel' => encrypt($row->id)]) }}"
                                                class="btn btn-primary">
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

        {{-- History --}}
        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $cardTitleHis }}</h5>

                            <!-- Table with stripped rows -->
                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Judul Tugas Rumah</th>
                                        <th scope="col">Penjelasan</th>
                                        <th scope="col">Tanggat</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr scope="row">
                                        <?php
                                            $no = 1;
                                            foreach($history as $key => $row) {
                                        ?>
                                        <td><?= $no++ ?></td>
                                        <td><?= $row->judulPr ?></td>
                                        <td><?= $row->deskripsi ?></td>
                                        <td><?= $row->tenggat ?></td>
                                        <td><?= $row->status ?></td>
                                        <td>
                                            <a style="text-decoration-style: none"
                                                href="{{ route('detail', ['kode_kel' => encrypt($row->id)]) }}"
                                                class="btn btn-primary">
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

    </main>
    @include('content.modal.modalTugasRumah');
@endsection
