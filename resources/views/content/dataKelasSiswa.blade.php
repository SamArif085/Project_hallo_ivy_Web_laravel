@extends('layout.mainLayout')
@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>{{ $title }}</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboardAdmin') }}">Dashboard</a></li>
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
                                data-bs-target="#addKelas">
                                Tambah Kelas
                            </button>

                            <!-- Table with stripped rows -->
                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Kode Kelas</th>
                                        <th scope="col">Keterangan Kelas</th>
                                        <th scope="col">Aksi</th>
                                        {{-- <th scope="col">Age</th> --}}
                                        {{-- <th scope="col">Start Date</th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <?php
                                            $no = 1;
                                            foreach($kodeKelas as $key => $row) {
                                        ?>
                                        <th>{{ $no++ }}</th>
                                        <th>{{ $row->kode_kelas }}</th>
                                        <td>{{ $row->ket_kelas }}</td>
                                        <td>
                                            <a href="javascript:void(0)" data-id="{{ encrypt($row->kode_kelas) }}"
                                                id="btn-ubah-kelas" class="btn btn-warning">
                                                <i class="bi bi-pencil-fill"></i>
                                            </a>
                                            {{-- <a href="javascript:void(0)" data-id="{{ encrypt($row->kode_kelas) }}"
                                                id="btn-hapus-guru" class="btn btn-danger">
                                                <i class="bi bi-trash-fill"></i>
                                            </a> --}}
                                            <a href="{{ route('detailDataSiswa', ['kode_kelas' => encrypt($row->kode_kelas)]) }}"
                                                id="btn-detail-guru" class="btn btn-primary">
                                                <i class="bi bi-info-square"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php
                                            }
                                        ?>
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
    <div class="modal fade" id="addKelas" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">{{ $modal['tambah'] }}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="form-tambah-kelas">
                        @csrf
                        <div class="mb-3">
                            <div id="" class="form-text">
                                <i style="color: red">*</i>
                                Contoh Kode Kelas : kel-1
                            </div>
                            <label for="exampleFormControlInput1" class="form-label">Kode Kelas</label>
                            <input type="text" class="form-control mb-3" name="kodeKelasTambahKelas"
                                id="kodeKelasTambahKelas" required>
                            <label for="exampleFormControlInput1" class="form-label">Keterangan Kelas</label>
                            <input type="text" class="form-control mb-3" name="ketTambahKelas" id="ketTambahKelas"
                                required>
                            <label for="exampleFormControlInput1" class="form-label">Gambar Cover Kelas</label>
                            <input type="text" class="form-control mb-3" name="namaTambahImageKelas"
                                id="namaTambahImageKelas" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <div id="loading-tambah-kelas" style="display: none;">
                        <button class="btn btn-primary" type="button" disabled>
                            <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
                            <span role="status">Loading...</span>
                        </button>
                    </div>
                    <button type="submit" class="btn btn-success" id="simpan-kelas">Simpan Data</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit Materi -->
    <div class="modal fade" id="ubahKelas" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">{{ $modal['tambah'] }}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="form-tambah-kelas">
                        @csrf
                        <div class="mb-3">
                            <div id="" class="form-text">
                                <i style="color: red">*</i>
                                Contoh Kode Kelas : kel-1
                            </div>
                            <label for="exampleFormControlInput1" class="form-label">Kode Kelas</label>
                            <input type="text" class="form-control mb-3" name="kodeKelasUbahKelas"
                                id="kodeKelasUbahKelas" required>
                            <label for="exampleFormControlInput1" class="form-label">Keterangan Kelas</label>
                            <input type="text" class="form-control mb-3" name="ketUbahKelas" id="ketUbahKelas"
                                required>
                            <label for="exampleFormControlInput1" class="form-label">Gambar Cover Kelas</label>
                            <input type="text" class="form-control mb-3" name="namaUbahImageKelas"
                                id="namaUbahImageKelas" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <div id="loading-ubah-kelas" style="display: none;">
                        <button class="btn btn-primary" type="button" disabled>
                            <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
                            <span role="status">Loading...</span>
                        </button>
                    </div>
                    <button type="submit" class="btn btn-success" id="simpan-kelas-ubah">Simpan Data</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Hapus Materi -->

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        $('#simpan-kelas').on('click', function(e) {
            e.preventDefault();

            // let data = [];
            var kodeKelas = $('#kodeKelasTambahKelas').val();
            var ketKelas = $('#ketTambahKelas').val();
            var namaImageKelas = $('#namaTambahImageKelas').val();

            let form = $('#form-tambah-kelas').serialize();

            // console.log(form);

            $.ajax({
                type: "POST",
                url: "/createKelas",
                data: form,
                beforeSend: function() {
                    $("#loading-tambah-kelas").show();
                    $("#simpan-kelas").hide();
                },
                success: function(response) {
                    $("#addKelas").hide();

                    Swal.fire({
                        type: "success",
                        icon: "success",
                        title: `${response.message}`,
                        showConfirmButton: false,
                        timer: 3000,
                    }).then((result) => location.reload());
                },
            });
        });

        $('body').on('click', '#btn-ubah-kelas', function() {

            let id = $(this).data('id')

            // console.log(id);

            $.ajax({
                type: "GET",
                url: `/detailKelas/${id}`,
                data: "data",
                // dataType: "dataType",
                beforeSend: function() {
                    Swal.fire({
                        position: "center",
                        title: "Proses ambil data . . .",
                        allowOutsideClick: false,
                        showConfirmButton: false,
                        // toast: true,
                        html: '<div class="spinner-grow text-primary" role="status"><span class = "visually-hidden" > Proses ambil data . . . < /span></div>',
                        timer: 2000,
                    });
                },
                success: function(response) {
                    $('#kodeKelasUbahKelas').val(response.kodeKelas);
                    $('#ketUbahKelas').val(response.ketKelas);
                    $('#namaUbahImageKelas').val(response.imageKelas);

                    $('#ubahKelas').modal('show');
                }
            });

        })
    </script>
@endsection
