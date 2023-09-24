@extends('layout.detailLayout')
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
                                            <a href="javascript:void(0)" id="btn-edit-materi" class="btn btn-warning"
                                                data-id="{{ $row->id_materi }}"><i class="bi bi-pencil-fill"></i></a>
                                            <a href="javascript:void(0)" id="btn-hapus-materi" class="btn btn-danger"
                                                data-id="{{ $row->id_materi }}"><i class="bi bi-trash-fill"></i></a>
                                            <a href=""></a>
                                            <a style="text-decoration-style: none"
                                                href="{{ route('detQuiz', ['id_materi' => encrypt($row->id_materi)]) }}"
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

    </main><!-- End #main -->

    <!-- Kumpulan Modal -->
    <!-- Modal Tambah Materi -->
    <div class="modal fade" id="addMateri" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">{{ $modalTitle['materi'] }}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="form_tambah">
                        @csrf
                        <div class="mb-3">
                            <input type="hidden" class="form-control mb-3" name="kodeKelas" id="kodeKelas"
                                value="{{ $kodeKelas }}" placeholder="{{ $kodeKelas }}" required>
                            <div class="row">
                                <div class="col-4">
                                    <label for="exampleFormControlInput1" class="form-label">Jenis Tema</label>
                                    <input type="text" class="form-control mb-3" name="jenisTemaTam" id="jenisTemaTam"
                                        required>
                                    {{-- <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-jenis"></div> --}}
                                </div>
                                <div class="col-8">
                                    <label for="exampleFormControlInput1" class="form-label">Judul Materi</label>
                                    <input type="text" class="form-control mb-3" name="judulMatTam" id="judulMatTam"
                                        required>
                                </div>
                            </div>
                            <label for="exampleFormControlInput1" class="form-label">Link Materi</label>
                            <input type="text" class="form-control mb-3" name="linkMatTam" id="linkMatTam" required>
                            <label for="exampleFormControlInput1" class="form-label">Gambar Cover</label>
                            <input type="text" class="form-control mb-3" name="gamCovTam" id="gamCovTam" required>
                            <label for="exampleFormControlInput1" class="form-label">Gambar Materi</label>
                            <input type="text" class="form-control mb-3" name="gamMatTam" id="gamMatTam" required>
                        </div>
                </div>
                <div class="modal-footer">
                    <div id="loading-tambah" style="display: none;">
                        <button class="btn btn-primary" type="button" disabled>
                            <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
                            <span role="status">Loading...</span>
                        </button>
                    </div>
                    <button type="submit" id="simpanTambah" class="btn btn-success simpan">Simpan Data</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Edit Materi -->
    <div class="modal fade" id="editMateri" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">{{ $modalTitle['editMateri'] }}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="form-edit">
                        @csrf
                        <div class="mb-3">
                            {{-- <input type="hidden" class="form-control mb-3" name="kode_kelas" id="kode_kelas_edit"
                                value="{{ $kodeKelas }}" placeholder="{{ $kodeKelas }}" required> --}}
                            <input type="hidden" class="form-control mb-3" name="id_materi" id="idMatEdit" required>
                            <div class="row">
                                <div class="col-4">
                                    <label for="exampleFormControlInput1" class="form-label">Jenis Tema</label>
                                    <input type="text" class="form-control mb-3" name="jenis_tema" id="jenisTemaEdit"
                                        required>
                                </div>
                                <div class="col-8">
                                    <label for="exampleFormControlInput1" class="form-label">Judul
                                        Materi</label>
                                    <input type="text" class="form-control mb-3" name="judul_materi"
                                        id="judulTemaEdit" required>
                                </div>
                            </div>
                            <label for="exampleFormControlInput1" class="form-label">Link Materi</label>
                            <input type="text" class="form-control mb-3" name="link_materi" id="linkTemaEdit"
                                required>
                            <label for="exampleFormControlInput1" class="form-label">Gambar Cover</label>
                            <input type="text" class="form-control mb-3" name="gambar_cover" id="gamCovEdit"
                                required>
                            <label for="exampleFormControlInput1" class="form-label">Gambar Materi</label>
                            <input type="text" class="form-control mb-3" name="gambar_materi" id="gamMatEdit"
                                required>
                        </div>
                </div>
                <div class="modal-footer">
                    <div id="loading-edit" style="display: none;">
                        <button class="btn btn-primary" type="button" disabled>
                            <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
                            <span role="status">Loading...</span>
                        </button>
                    </div>
                    <button type="submit" id="simpanEdit" class="btn btn-success simpanEdit">Simpan Data</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal hapus Materi -->
    <div class="modal fade" id="deleteMateri" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">
                        {{ $modalTitle['hapusMateri'] }}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="form-hapus" action="{{ route('hapusMateri') }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <input type="hidden" class="form-control mb-3" name="id_materi" id="idMateriHap" required>
                            <input type="hidden" class="form-control mb-3" name="kode_kelas" id="kodKelHap"
                                value="{{ $kodeKelas }}" required>
                            <div class="row">
                                <div class="col-4">
                                    <label for="exampleFormControlInput1" class="form-label">Jenis Tema</label>
                                    <input type="text" class="form-control mb-3" name="jenis_tema" id="jenisTemaHap"
                                        required disabled>
                                </div>
                                <div class="col-8">
                                    <label for="exampleFormControlInput1" class="form-label">Judul
                                        Materi</label>
                                    <input type="text" class="form-control mb-3" name="judul_materi"
                                        id="judulTemaHap" required disabled>
                                </div>
                            </div>
                            <label for="exampleFormControlInput1" class="form-label">Link
                                Materi</label>
                            <input type="text" class="form-control mb-3" name="link_materi" id="linkTemaHap" required
                                disabled>
                            <label for="exampleFormControlInput1" class="form-label">Gambar
                                Cover</label>
                            <input type="text" class="form-control mb-3" name="gambar_cover" id="gamTemaHap" required
                                disabled>
                            <label for="exampleFormControlInput1" class="form-label">Gambar
                                Materi</label>
                            <input type="text" class="form-control mb-3" name="gambar_materi" id="gamMatHap" required
                                disabled>
                        </div>
                </div>
                <div class="modal-footer">
                    <div id="loading-hapus" style="display: none;">
                        <button class="btn btn-primary" type="button" disabled>
                            <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
                            <span role="status">Loading...</span>
                        </button>
                    </div>
                    <button type="submit" id="hapus-data" class="btn btn-danger">Hapus Data</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    {{-- JavaScript --}}
    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> --}}

    {{-- <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // Simpan Tambah Data
        $('#simpan-data').click(function(e) {
            e.preventDefault();

            let form = $('#form_tambah').serialize();

            console.log(form);

            $.ajax({
                type: "POST",
                url: "{{ route('tambahMateri') }}",
                data: form,
                dataType: "JSON",
                beforeSend: function() {
                    $(".simpan").hide();
                    $("#loading-tambah").show();
                }, //menampilkan loading saat mengirimkan data
                success: function(response) {
                    $('#addMateri').hide();

                    Swal.fire({
                        type: 'success',
                        icon: 'success',
                        title: `${response.message}`,
                        showConfirmButton: false,
                        timer: 3000
                    }).then((result) =>
                        location.reload()
                    );
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    Swal.fire({
                            type: 'error',
                            icon: 'error',
                            title: `${xhr.status}`,
                            text: 'Semua Bidang Harap Diisi !!!',
                            showConfirmButton: false,
                            // location: reload,
                            timer: 1500
                        })
                        .then((result) =>
                            location.reload()
                        );
                    // alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });
        });

        // Simpan Ubah Data
        $('body').on('click', '#btn-edit-materi', function() {
            let id = $(this).data('id');
            // console.log(id);

            $.ajax({
                type: "GET",
                url: `/detailShow/${id}`,
                // data: "data",
                // cache: false,
                success: function(response) {
                    $('#idMatEdit').val(response.idMateri);
                    $('#jenisTemaEdit').val(response.jenisTema);
                    $('#judulTemaEdit').val(response.judulMateri);
                    $('#linkTemaEdit').val(response.linkMateri);
                    $('#gamCovEdit').val(response.gambarCover);
                    $('#gamMatEdit').val(response.gambarMateri);

                    // console.log(idMateri);
                    $('#editMateri').modal('show');
                }
            });

        });
        $('#simpanEdit').click(function(e) {
            e.preventDefault();

            let form = $('#form-edit').serialize();

            $.ajax({
                type: "POST",
                url: "{{ route('editMateri') }}",
                data: form,
                dataType: "JSON",
                beforeSend: function() {
                    $(".simpanEdit").hide();
                    $("#loading-edit").show();
                }, //menampilkan loading saat mengirimkan data
                success: function(response) {
                    $('#editMateri').hide();
                    Swal.fire({
                        type: 'success',
                        icon: 'success',
                        title: `${response.message}`,
                        showConfirmButton: false,
                        timer: 3000
                    }).then((result) =>
                        location.reload()
                    );
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    Swal.fire({
                        type: 'error',
                        icon: 'error',
                        title: `${xhr.status}`,
                        showConfirmButton: false,
                        // location: reload,
                        timer: 1500
                    }).then((result) =>
                        location.reload()
                    );
                },
                // complete function
                // complete: function() {
                //     $(".alert").hide();
                // }
            });
        });

        // Hapus Data Materi
        $('body').on('click', '#btn-hapus-materi', function() {
            let id = $(this).data('id');
            // console.log(id);

            $.ajax({
                type: "GET",
                url: `/detailShow/${id}`,
                // data: "data",
                // cache: false,
                success: function(response) {
                    $('#idMateriHap').val(response.idMateri);
                    $('#jenisTemaHap').val(response.jenisTema);
                    $('#judulTemaHap').val(response.judulMateri);
                    $('#linkTemaHap').val(response.linkMateri);
                    $('#gamTemaHap').val(response.gambarCover);
                    $('#gamMatHap').val(response.gambarMateri);

                    // console.log(idMateri);
                    $('#deleteMateri').modal('show');
                }
            });
        });
        $('#hapus-data').click(function(e) {
            e.preventDefault();

            let form = $('#form-hapus').serialize();

            $.ajax({
                type: "POST",
                url: "{{ route('hapusMateri') }}",
                data: form,
                dataType: "JSON",
                beforeSend: function() {
                    $("#hapus-data").hide();
                    $("#loading-hapus").show();
                }, //menampilkan loading saat mengirimkan data
                success: function(response) {
                    $('#deleteMateri').hide();

                    if (response.message) {
                        Swal.fire({
                            type: 'success',
                            icon: 'success',
                            title: `${response.message}`,
                            showConfirmButton: false,
                            timer: 3000
                        }).then((result) =>
                            location.reload()
                        );
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    Swal.fire({
                        type: 'error',
                        icon: 'error',
                        title: `${xhr.status}`,
                        showConfirmButton: false,
                        // location: reload,
                        timer: 1500
                    }).then((result) =>
                        location.reload()
                    );
                },
            });
        });
    </script> --}}
@endsection
