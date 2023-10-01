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
    <!-- Modal Tambah Quiz -->
    <div class="modal fade" id="addQuiz" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">{{ $modalTitle['tambah'] }}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="form-tambah-quiz">
                        @csrf
                        <div class="mb-3">
                            <input type="hidden" class="form-control mb-3" name="idMateriTambahQuiz"
                                id="idMateriTambahQuiz" value="{{ $idMateri }}" required>
                            <div class="row">
                                <div class="col-9">
                                    <label for="exampleFormControlInput1" class="form-label">Pertanyaan</label>
                                    <input type="text" class="form-control mb-3" name="quizTambah" id="quizTambah"
                                        required>
                                </div>
                                <div class="col-3">
                                    <label for="exampleFormControlInput1" class="form-label">Jawaban</label>
                                    <select class="form-select" name="jawabTambah" id="jawabTambah"
                                        aria-label="Default select example">
                                        <option selected>Pilih Jawab</option>
                                        <option value="1">Betul</option>
                                        <option value="2">Salah</option>
                                    </select>
                                </div>
                            </div>
                            <label for="exampleFormControlInput1" class="form-label">Link Gambar</label>
                            <textarea name="imageQuizTambah" id="imageQuizTambah" cols="10" rows="1" class="form-control mb-3"></textarea>
                        </div>
                </div>
                <div class="modal-footer">
                    <div id="loading-tam-quiz" style="display: none;">
                        <button class="btn btn-primary" type="button" disabled>
                            <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
                            <span role="status">Loading...</span>
                        </button>
                    </div>
                    <button type="button" class="btn btn-success" id="simpanTamQuiz">Simpan Data</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Ubah Quiz -->
    <!-- Modal Hapus Quiz -->
    <!-- Modal Detail Quiz -->
    <div class="modal fade" id="detailQuiz" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">{{ $modalTitle['detail'] }}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="form-detail-quiz">
                        @csrf
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Pertanyaan</label>
                            <input type="text" class="form-control mb-3" name="perta" id="pertaDetail" required>
                            <label for="exampleFormControlInput1" class="form-label">Link Gambar</label>
                            <textarea name="imageQuiz" id="imageQuizDetail" cols="10" rows="2" class="form-control mb-3"></textarea>
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

        // Tambah Data
        $('#simpanTamQuiz').on('click', function(e) {
            e.preventDefault();

            let data = $('#form-tambah-quiz').serialize();
            let idQuiz = $('#idMateriTambahQuiz').val();
            let perta = $('#quizTambah').val();
            let imageQuiz = $('#imageQuizTambah').val();
            let jawab = $('#jawabTambah').val();

            console.log(data);

            $.ajax({
                type: "POST",
                url: "/createQuiz",
                data: data,
                dataType: "json",
                beforeSend: function() {
                    $("#loading-tam-quiz").show();
                    $("#simpanTamQuiz").hide();
                },
                success: function(response) {
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Data berhasil ditambahkan',
                        showConfirmButton: false,
                        timer: 1500
                    });
                    $('#form-detail-quiz')[0].reset();
                    $('#addQuiz').modal('hide');
                    location.reload();
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    // $('#pertaError').text(response.responseJSON.errors.perta);
                    // $('#imageQuizError').text(response.responseJSON.errors.imageQuiz);
                    $("#loading-tam-quiz").hide();
                    $("#simpanTamQuiz").show();
                    if (perta == "") {
                        Swal.fire({
                            type: "error",
                            icon: "error",
                            title: `${xhr.status}`,
                            text: "Pertanyaan Harap Diisi !!!",
                            showConfirmButton: true,
                            // location: reload,
                            // timer: 1500
                        });
                    }
                }
            });
        });
        // Button Detail Quiz
        $('body').on('click', '#btn-detail-quiz', function() {
            let id = $(this).data('id');
            console.log(id);

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
                    // $('#idQuiz').val(response.idQuiz);
                    $('#pertaDetail').val(response.perta);
                    $('#imageQuizDetail').val(response.imageQuiz);
                    // console.log(pert);
                    $('#detailQuiz').modal('show');
                }
            });
        });
    </script>
@endsection
