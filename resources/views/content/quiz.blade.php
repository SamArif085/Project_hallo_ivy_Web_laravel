@extends('layout.detail2Layout')
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

    <!-- Kumpulan Modal -->
    <!-- Modal Tambah Materi -->
    <div class="modal fade" id="detailQuiz" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">{{ $modalTitle['detail'] }}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="loading-tambah" style="display: none;">
                        <button class="btn btn-primary" type="button" disabled>
                            <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
                            <span role="status">Loading...</span>
                        </button>
                    </div>
                    <form id="form-detail-quiz">
                        @csrf
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Pertanyaan</label>
                            <input type="text" class="form-control mb-3" name="perta" id="perta" required>
                            <label for="exampleFormControlInput1" class="form-label">Link Gambar</label>
                            <textarea name="imageQuiz" id="imageQuiz" cols="10" rows="2" class="form-control mb-3"></textarea>
                            {{-- <input type="text" class="form-control mb-3" name="imageQuiz" id="imageQuiz" required> --}}
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger simpan" data-bs-dismiss="modal">Tutup Modal</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // Button Detail Quiz
        $('body').on('click', '#btn-detail-quiz', function() {
            let id = $(this).data('id');
            // console.log(id);

            $.ajax({
                type: "GET",
                url: `/detailDataQuiz/${id}`,
                // data: "data",
                // cache: false,
                beforeSend: function() {
                    // $("#loading-detail-quiz").show();
                    // $("#form-detail-quiz").hide();
                    Swal.fire({
                        position: 'center',
                        title: 'Loading...',
                        allowOutsideClick: false,
                        showConfirmButton: false,
                        // toast: true,
                        html: '<div class="spinner-grow text-primary" role="status"><span class = "visually-hidden" > Loading... < /span></div>',
                        timer: 2000
                    });
                },
                success: function(response) {
                    $('#idQuiz').val(response.idQuiz);
                    $('#perta').val(response.perta);
                    $('#imageQuiz').val(response.imageQuiz);
                    $('#detailQuiz').modal('show');
                }
            });
        });
    </script>
@endsection
