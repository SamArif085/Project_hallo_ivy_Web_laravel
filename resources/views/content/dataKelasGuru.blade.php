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
                                data-bs-target="#tambahGuru">
                                Tambah Guru
                            </button>

                            <a href="{{ route('dataKelas') }}" class="btn btn-secondary">Kembali</a>

                            <!-- Table with stripped rows -->
                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Nama Guru</th>
                                        <th scope="col">Keterangan Kelas</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr scope="row">
                                        <?php
                                            $no = 1;
                                            foreach($dataGuru as $key => $row) {
                                        ?>
                                        <td><?= $no++ ?></td>
                                        <td><?= $row->nama ?></td>
                                        <td><?= $row->ket_kelas ?></td>
                                        <td>
                                            <a href="javascript:void(0)" data-id="{{ base64_encode($row->id) }}"
                                                data-id_deg="{{ base64_encode($row->id_deg) }}" id="btn-ubah-guru"
                                                class="btn btn-warning">
                                                <i class="bi bi-pencil-fill"></i>
                                            </a>
                                            <a href="javascript:void(0)" data-id="{{ base64_encode($row->id) }}"
                                                data-id_deg="{{ base64_encode($row->id_deg) }}" id="btn-hapus-guru"
                                                class="btn btn-danger">
                                                <i class="bi bi-trash-fill"></i>
                                            </a>
                                            {{-- <a href="javascript:void(0)" data-id="{{ base64_encode($row->id) }}"
                                                id="btn-detail-guru" class="btn btn-primary">
                                                <i class="bi bi-info-square"></i>
                                            </a> --}}
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
    @include('content.modal.modalGuru');

    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> --}}

    <script>
        // $.ajaxSetup({
        //     headers: {
        //         "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        //     },
        // });

        // // Tambah Guru
        // $('#simpan-data-guru').on('click', function(e) {
        //     e.preventDefault()

        //     var nama = $('#namaTambahGuru').val()
        //     var jenisKelamin = $('#jenisKelaminGuru').val()
        //     var kodeKelas = $('#kodeKelasTambahGuru').val()
        //     var username = $('#usernameTambahGuru').val()
        //     var password = $('#passwordTambahGuru').val()

        //     var data = $('#form-tambah-guru').serialize()
        //     $.ajax({
        //         type: "POST",
        //         url: "/createGuru",
        //         data: data,
        //         dataType: "JSON",
        //         beforeSend: function() {
        //             $('#loading-tambah-guru').show()
        //             $('#simpan-data-guru').hide()
        //         },
        //         success: function(response) {
        //             $("#tambahGuru").hide();

        //             Swal.fire({
        //                 type: "success",
        //                 icon: "success",
        //                 title: `${response.message}`,
        //                 showConfirmButton: false,
        //                 timer: 3000,
        //             }).then((result) => location.reload());
        //         },
        //         error: function(xhr, ajaxOptions, thrownError) {
        //             $('#loading-tambah-guru').hide()
        //             $('#simpan-data-guru').show()

        //             if (nama === "") {
        //                 Swal.fire({
        //                     type: "error",
        //                     icon: "error",
        //                     title: `${xhr.status}`,
        //                     text: "Nama Guru Harap Diisi !!!",
        //                     showConfirmButton: true,
        //                 });
        //             }
        //             if (jenisKelamin === "") {
        //                 Swal.fire({
        //                     type: "error",
        //                     icon: "error",
        //                     title: `${xhr.status}`,
        //                     text: "Jenis Kelamin Guru Harap Dipilih !!!",
        //                     showConfirmButton: true,
        //                 });
        //             }
        //             if (kodeKelas === "") {
        //                 Swal.fire({
        //                     type: "error",
        //                     icon: "error",
        //                     title: `${xhr.status}`,
        //                     text: "Kelas Guru Harap Dipilih !!!",
        //                     showConfirmButton: true,
        //                 });
        //             }
        //             if (username === "") {
        //                 Swal.fire({
        //                     type: "error",
        //                     icon: "error",
        //                     title: `${xhr.status}`,
        //                     text: "Username Guru Harap Diisi !!!",
        //                     showConfirmButton: true,
        //                 });
        //             }
        //             if (password === "") {
        //                 Swal.fire({
        //                     type: "error",
        //                     icon: "error",
        //                     title: `${xhr.status}`,
        //                     text: "Password Guru Harap Diisi !!!",
        //                     showConfirmButton: true,
        //                 });
        //             }

        //         }
        //     });

        // })

        // // Detail Guru
        // $('body').on('click', '#btn-detail-guru', function(e) {
        //     e.preventDefault();

        //     let id = $(this).data('id')

        //     $.ajax({
        //         type: "GET",
        //         url: `detailGuru/${id}`,
        //         // data: "data",
        //         // dataType: "dataType",
        //         beforeSend: function() {
        //             Swal.fire({
        //                 position: "center",
        //                 title: "Proses ambil data . . .",
        //                 allowOutsideClick: false,
        //                 showConfirmButton: false,
        //                 // toast: true,
        //                 html: '<div class="spinner-grow text-primary" role="status"><span class = "visually-hidden" > Proses ambil data . . . < /span></div>',
        //                 timer: 2000,
        //             });
        //         },
        //         success: function(response) {
        //             $('#namaDetailGuru').val(response.namaGuru)
        //             $('#kodeKelasDetailGuru').val(response.kodeKelas)
        //             $('#ketKelasDetailGuru').val(response.ketKelas)
        //             $('#usernameDetailGuru').val(response.username)
        //             // $('#passwordDetailGuru').val(response.password)

        //             $('#detailGuru').modal('show');
        //         }
        //     });
        // })

        // // Ubah Guru
        // $('body').on('click', '#btn-ubah-guru', function(e) {
        //     e.preventDefault();

        //     let id = $(this).data('id')

        //     $.ajax({
        //         type: "GET",
        //         url: `detailGuru/${id}`,
        //         // data: "data",
        //         // dataType: "dataType",
        //         beforeSend: function() {
        //             Swal.fire({
        //                 position: "center",
        //                 title: "Proses ambil data . . .",
        //                 allowOutsideClick: false,
        //                 showConfirmButton: false,
        //                 // toast: true,
        //                 html: '<div class="spinner-grow text-primary" role="status"><span class = "visually-hidden" > Proses ambil data . . . < /span></div>',
        //                 timer: 2000,
        //             });
        //         },
        //         success: function(response) {
        //             $('#idUbahGuru').val(response.idGuru)
        //             $('#namaUbahGuru').val(response.namaGuru)
        //             $('#ketKodeKelas').val(response.kodeKelas + ` - ` + response.ketKelas)
        //             $('#kodeKelasUbahGuruLama').val(response.kodeKelas)
        //             // $('#ketKelasDetailGuru').val(response.ketKelas)
        //             $('#usernameUbahGuru').val(response.username)
        //             $('#jenisKela').val(response.jeKal)
        //             $('#jenisKelaUbahGuruLama').val(response.idJeKal)
        //             $('#passwordUbahGuruLama').val(response.password)

        //             $('#ubahGuru').modal('show');
        //         }
        //     });
        // })
        // $('#simpan-ubah-guru').on('click', function() {

        //     var data = $('#form-ubah-guru').serialize()
        //     // console.log(data);
        //     $.ajax({
        //         type: "POST",
        //         url: "/updateGuru",
        //         data: data,
        //         // dataType: "dataType",
        //         beforeSend: function() {
        //             $('#loading-ubah-guru').show()
        //             $('#simpan-ubah-guru').hide()
        //         },
        //         success: function(response) {
        //             $("#ubahGuru").hide();

        //             Swal.fire({
        //                 type: "success",
        //                 icon: "success",
        //                 title: `${response.message}`,
        //                 showConfirmButton: false,
        //                 timer: 3000,
        //             }).then((result) => location.reload());
        //         },
        //         error: function(xhr, ajaxOptions, thrownError) {
        //             $("#loading-edit").hide();
        //             $(".simpanEdit").show();
        //             Swal.fire({
        //                 type: "error",
        //                 icon: "error",
        //                 title: `${xhr.status}`,
        //                 showConfirmButton: true,
        //                 // location: reload,
        //                 // timer: 1500
        //             });
        //         },
        //     });
        // });

        // // Ubah Guru
        // $('body').on('click', '#btn-hapus-guru', function(e) {
        //     e.preventDefault();

        //     let id = $(this).data('id')

        //     $.ajax({
        //         type: "GET",
        //         url: `detailGuru/${id}`,
        //         // data: "data",
        //         // dataType: "dataType",
        //         beforeSend: function() {
        //             Swal.fire({
        //                 position: "center",
        //                 title: "Proses ambil data . . .",
        //                 allowOutsideClick: false,
        //                 showConfirmButton: false,
        //                 // toast: true,
        //                 html: '<div class="spinner-grow text-primary" role="status"><span class = "visually-hidden" > Proses ambil data . . . < /span></div>',
        //                 timer: 2000,
        //             });
        //         },
        //         success: function(response) {
        //             $('#idHapusGuru').val(response.idGuru)
        //             $('#namaHapusGuru').val(response.namaGuru)
        //             $('#ketKodeKelasHapus').val(response.kodeKelas + ` - ` + response.ketKelas)
        //             // $('#kodeKelasUbahGuruLama').val(response.kodeKelas)
        //             // $('#ketKelasDetailGuru').val(response.ketKelas)
        //             $('#usernameHapusGuru').val(response.username)
        //             $('#jenisKelaHapus').val(response.jeKal)
        //             // $('#jenisKelaUbahGuruLama').val(response.idJeKal)
        //             // $('#passwordUbahGuruLama').val(response.password)

        //             $('#hapusGuru').modal('show');
        //         }
        //     });
        // })
        // $('#simpan-hapus-guru').on('click', function() {

        //     var data = $('#form-hapus-guru').serialize()
        //     // console.log(data);
        //     $.ajax({
        //         type: "POST",
        //         url: "/deleteGuru",
        //         data: data,
        //         // dataType: "dataType",
        //         beforeSend: function() {
        //             $('#loading-hapus-guru').show()
        //             $('#simpan-hapus-guru').hide()
        //         },
        //         success: function(response) {
        //             $("#hapusGuru").hide();

        //             Swal.fire({
        //                 type: "success",
        //                 icon: "success",
        //                 title: `${response.message}`,
        //                 showConfirmButton: false,
        //                 timer: 3000,
        //             }).then((result) => location.reload());
        //         },
        //         error: function(xhr, ajaxOptions, thrownError) {
        //             $("#loading-edit").hide();
        //             $(".simpanEdit").show();
        //             Swal.fire({
        //                 type: "error",
        //                 icon: "error",
        //                 title: `${xhr.status}`,
        //                 showConfirmButton: true,
        //                 // location: reload,
        //                 // timer: 1500
        //             });
        //         },
        //     });
        // });
    </script>
@endsection
