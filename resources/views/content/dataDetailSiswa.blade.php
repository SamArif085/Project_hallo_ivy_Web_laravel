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
                                data-bs-target="#addSiswa">
                                Tambah Siswa
                            </button>

                            <!-- Table with stripped rows -->
                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">NISN</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">Jenis Kelamin</th>
                                        <th scope="col">Kelas</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <?php
                                            $no = 1;
                                            foreach($dataSiswa as $key => $row) {
                                        ?>
                                        <th>{{ $no++ }}</th>
                                        <th>{{ $row->nisn }}</th>
                                        <td>{{ $row->nama }}</td>
                                        <td>{{ $row->jekal == 'L' ? 'LAKI-LAKI' : 'PEREMPUAN' }}</td>
                                        <td>{{ $row->ket_kelas }}</td>
                                        <td>
                                            <a href="javascript:void(0)" data-nisn="{{ $row->nisn }}" id="btn-ubah-siswa"
                                                class="btn btn-warning">
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
    <div class="modal fade" id="addSiswa" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">{{ $modal['tambah'] }}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="form-tambah-siswa">
                        @csrf
                        <div class="mb-3">
                            {{-- <div id="" class="form-text">
                                <i style="color: red">*</i>
                                Contoh Kode Kelas : kel-1
                            </div> --}}
                            <div class="row">
                                <div class="col-4">
                                    <label for="exampleFormControlInput1" class="form-label">NISN</label>
                                    <input type="text" class="form-control mb-3" name="nisnTambah" id="nisnTambah"
                                        required>
                                </div>
                                <div class="col-8">
                                    <label for="exampleFormControlInput1" class="form-label">Nama Siswa</label>
                                    <input type="text" class="form-control mb-3" name="namaSisTambah" id="namaSisTambah"
                                        required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <label for="exampleFormControlInput1" class="form-label">Kelas</label>
                                    <input type="text" class="form-control mb-3" name="kodeKelTamSiswa"
                                        id="kodeKelTamSiswa" required value="{{ $kd_kls }}" readonly>
                                </div>
                                <div class="col-8">
                                    <label for="exampleFormControlInput1" class="form-label">Jenis Kelamin</label>
                                    <select class="form-select" aria-label="Default select example" name="jekelSisTambah"
                                        id="jekelSisTambah">
                                        <option value="null">Pilih Jenis Kelamin</option>
                                        <option value="L">Laki-Laki</option>
                                        <option value="P">Perempuan</option>
                                    </select>
                                </div>
                            </div>
                            {{-- <div class="row">
                                <div class="col-5">
                                    <label for="exampleFormControlInput1" class="form-label">Password</label>
                                    <input type="text" class="form-control mb-3" name="passTamSis"
                                        id="passTamSis" required>
                                </div>
                            </div> --}}
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <div id="loading-tambah-siswa" style="display: none;">
                        <button class="btn btn-primary" type="button" disabled>
                            <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
                            <span role="status">Loading...</span>
                        </button>
                    </div>
                    <button type="button" class="btn btn-success" id="simpan-siswa">Simpan Data</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit Materi -->
    <div class="modal fade" id="ubahSiswa" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">{{ $modal['tambah'] }}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="form-ubah-siswa">
                        @csrf
                        <div class="mb-3">
                            {{-- <div id="" class="form-text">
                                <i style="color: red">*</i>
                                Contoh Kode Kelas : kel-1
                            </div> --}}
                            <div class="row">
                                <div class="col-4">
                                    <label for="exampleFormControlInput1" class="form-label">NISN</label>
                                    <input type="text" class="form-control mb-3" name="nisnUbah" id="nisnUbah"
                                        required>
                                </div>
                                <div class="col-8">
                                    <label for="exampleFormControlInput1" class="form-label">Nama Siswa</label>
                                    <input type="text" class="form-control mb-3" name="namaSisUbah" id="namaSisUbah"
                                        required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <label for="exampleFormControlInput1" class="form-label">Kelas Lama</label>
                                    <input type="text" class="form-control mb-3" required
                                        value="{{ $kd_kls }} - {{ $ketKelas }}" readonly>
                                    <input type="hidden" class="form-control mb-3" name="kodeKelUbahSiswaLama"
                                        id="kodeKelUbahSiswaLama" required value="{{ $kd_kls }}" readonly>
                                </div>
                                <div class="col-6">
                                    <label for="exampleFormControlInput1" class="form-label">Jenis Kelamin Lama</label>
                                    <input type="text" class="form-control mb-3" name="jekelUbahSiswaLama"
                                        id="jekelUbahSiswaLama" required readonly>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <label for="exampleFormControlInput1" class="form-label">Kelas</label>
                                    <select class="form-select" aria-label="Default select example"
                                        name="kodeKelSisUbahBaru" id="kodeKelSisUbahBaru">
                                        <option value="null">Pilih Kelas Baru</option>
                                        @foreach ($kodeKelas as $kel => $kelas)
                                            <option value="{{ $kelas->kode_kelas }}">
                                                {{ $kelas->kode_kelas }} - {{ $kelas->ket_kelas }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-6">
                                    <label for="exampleFormControlInput1" class="form-label">Jenis Kelamin</label>
                                    <select class="form-select" aria-label="Default select example"
                                        name="jekelSisTambahBaru" id="jekelSisTambahBaru">
                                        <option value="null">Pilih Jenis Kelamin</option>
                                        <option value="L">Laki-Laki</option>
                                        <option value="P">Perempuan</option>
                                    </select>
                                </div>
                            </div>
                            {{-- <div class="row">
                                <div class="col-5">
                                    <label for="exampleFormControlInput1" class="form-label">Password</label>
                                    <input type="text" class="form-control mb-3" name="passTamSis"
                                        id="passTamSis" required>
                                </div>
                            </div> --}}
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

        $('#simpan-siswa').on('click', function(e) {
            e.preventDefault();

            // let data = [];
            var nisn = $('#nisnTambah').val();
            var nama = $('#namaSisTambah').val();
            var jekel = $('#jekelSisTambah').val();

            let form = $('#form-tambah-siswa').serialize();

            $.ajax({
                type: "POST",
                url: "/createSiswa",
                data: form,
                beforeSend: function() {
                    $("#loading-tambah-siswa").show();
                    $("#simpan-siswa").hide();
                },
                success: function(response) {
                    $("#addSiswa").hide();

                    Swal.fire({
                        type: "success",
                        icon: "success",
                        title: `${response.message}`,
                        showConfirmButton: false,
                        timer: 3000,
                    }).then((result) => location.reload());
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    $("#loading-tambah-siswa").hide();
                    $("#simpan-siswa").show();

                    if (nisn === "" || nisn === "null") {
                        Swal.fire({
                            type: "error",
                            icon: "error",
                            title: `${xhr.status}`,
                            text: "NISN Siswa Harap Diisi !!!",
                            showConfirmButton: true,
                        });
                    }
                    if (nama === '' || nama === 'null') {
                        Swal.fire({
                            type: "error",
                            icon: "error",
                            title: `${xhr.status}`,
                            text: "Nama Siswa Harap Diisi !!!",
                            showConfirmButton: true,
                        });
                    }
                    if (jekel === '' || jekel === 'null') {
                        Swal.fire({
                            type: "error",
                            icon: "error",
                            title: `${xhr.status}`,
                            text: "Jenis Kelamin Siswa Harap Diisi !!!",
                            showConfirmButton: true,
                        });
                    }
                }
            });
        });

        $('body').on('click', '#btn-ubah-siswa', function() {

            let nisn = $(this).data('nisn')

            // console.log(id);

            $.ajax({
                type: "GET",
                url: `/detailSiswa/${nisn}`,
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
                    $('#nisnUbah').val(response.nisn);
                    $('#namaSisUbah').val(response.nama);
                    $('#jekelUbahSiswaLama').val(response.jekal);
                    // $('#jekelUbahSiswaLama').val(response.imageKelas);

                    $('#ubahSiswa').modal('show');
                }
            });
        })

        $('#simpan-kelas-ubah').on('click', function(e) {
            e.preventDefault();

            // let data = [];
            // var nisn = $('#nisnUbah').val();
            // var nama = $('#namaSisUbah').val();
            // var jekel = $('#jekelSisTambahBaru').val();
            // var kelas = $('#kodeKelSisUbahBaru').val();

            let form = $('#form-ubah-siswa').serialize();

            $.ajax({
                type: "POST",
                url: "/updateSiswa",
                data: form,
                beforeSend: function() {
                    $("#loading-ubah-kelas").show();
                    $("#simpan-kelas-ubah").hide();
                },
                success: function(response) {
                    $("#ubahSiswa").hide();

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
    </script>
@endsection
