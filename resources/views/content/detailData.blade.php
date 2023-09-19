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

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{ session('success') }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>

            {{-- <script>
                document.addEventListener("DOMContentLoaded", function() {
                    $('#hasilModal').modal('show');
                });
            </script> --}}
        @endif

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
                                            <button class="btn btn-warning" data-bs-toggle="modal"
                                                data-bs-target="#editMateri<?= $row->id ?>">EDIT</button>
                                            <button class="btn btn-danger" data-bs-toggle="modal"
                                                data-bs-target="#addMateri">HAPUS</button>
                                        </td>
                                    </tr>
                                    <!-- Modal Edit Materi -->
                                    <div class="modal fade modalku" id="editMateri<?= $row->id ?>" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-md modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">
                                                        {{ $modalTitle['editMateri'] }}</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('editMateri') }}" method="post">
                                                        @csrf
                                                        <div class="mb-3">
                                                            {{-- <input type="hidden" class="form-control mb-3"
                                                                name="kode_kelas" id="kode_kelas"
                                                                value="{{ $kodeKelas }}"
                                                                placeholder="{{ $kodeKelas }}" required> --}}
                                                            <input type="hidden" class="form-control mb-3" name="id_materi"
                                                                id="id_materi" value="{{ encrypt($row->id) }}" required>
                                                            <div class="row">
                                                                <div class="col-4">
                                                                    <label for="exampleFormControlInput1"
                                                                        class="form-label">Jenis Tema</label>
                                                                    <input type="text" class="form-control mb-3"
                                                                        name="jenis_tema" id="jenis_tema"
                                                                        value="{{ $row->jenis_tema }}" required>
                                                                </div>
                                                                <div class="col-8">
                                                                    <label for="exampleFormControlInput1"
                                                                        class="form-label">Judul
                                                                        Materi</label>
                                                                    <input type="text" class="form-control mb-3"
                                                                        value="{{ $row->judul_materi }}" name="judul_materi"
                                                                        id="judul_materi" required>
                                                                </div>
                                                            </div>
                                                            <label for="exampleFormControlInput1" class="form-label">Link
                                                                Materi</label>
                                                            <input type="text" class="form-control mb-3"
                                                                value="{{ $row->link_materi }}" name="link_materi"
                                                                id="link_materi" required>
                                                            <label for="exampleFormControlInput1" class="form-label">Gambar
                                                                Cover</label>
                                                            <input type="text" class="form-control mb-3"
                                                                value="{{ $row->gambar_cover }}" name="gambar_cover"
                                                                id="gambar_cover" required>
                                                            <label for="exampleFormControlInput1" class="form-label">Gambar
                                                                Materi</label>
                                                            <input type="text" class="form-control mb-3"
                                                                value="{{ $row->gambar_materi }}" name="gambar_materi"
                                                                id="gambar_materi" required>
                                                        </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <div id="loading" style="display: none;">
                                                        <button class="btn btn-primary" type="button" disabled>
                                                            <span class="spinner-border spinner-border-sm"
                                                                aria-hidden="true"></span>
                                                            <span role="status">Loading...</span>
                                                        </button>
                                                    </div>
                                                    <button type="submit" id="kirimButton"
                                                        class="btn btn-success">Simpan
                                                        Data</button>
                                                </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
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
                    <div id="loading" style="display: none;">
                        Loading...
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('tambahMateri') }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <input type="hidden" class="form-control mb-3" name="kode_kelas" id="kode_kelas"
                                value="{{ $kodeKelas }}" placeholder="{{ $kodeKelas }}" required>
                            <div class="row">
                                <div class="col-4">
                                    <label for="exampleFormControlInput1" class="form-label">Jenis
                                        Tema</label>
                                    <input type="text" class="form-control mb-3" name="jenis_tema" id="jenis_tema"
                                        required>
                                </div>
                                <div class="col-8">
                                    <label for="exampleFormControlInput1" class="form-label">Judul
                                        Materi</label>
                                    <input type="text" class="form-control mb-3" name="judul_materi"
                                        id="judul_materi" required>
                                </div>
                            </div>
                            <label for="exampleFormControlInput1" class="form-label">Link Materi</label>
                            <input type="text" class="form-control mb-3" name="link_materi" id="link_materi"
                                required>
                            <label for="exampleFormControlInput1" class="form-label">Gambar Cover</label>
                            <input type="text" class="form-control mb-3" name="gambar_cover" id="gambar_cover"
                                required>
                            <label for="exampleFormControlInput1" class="form-label">Gambar Materi</label>
                            <input type="text" class="form-control mb-3" name="gambar_materi" id="gambar_materi"
                                required>
                        </div>
                </div>
                <div class="modal-footer">
                    <div id="loading" style="display: none;">
                        <button class="btn btn-primary" type="button" disabled>
                            <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
                            <span role="status">Loading...</span>
                        </button>
                    </div>
                    <button type="submit" id="kirimButton" class="btn btn-success">Simpan Data</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    {{-- <div class="modal" id="hasilModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">{{ $modalTitle['materi'] }}</h1>
                    <div id="loading" style="display: none;">
                        Loading...
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('tambahMateri') }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <input type="hidden" class="form-control mb-3" name="kode_kelas" id="kode_kelas"
                                value="{{ $kodeKelas }}" placeholder="{{ $kodeKelas }}" required>
                            <div class="row">
                                <div class="col-4">
                                    <label for="exampleFormControlInput1" class="form-label">Jenis
                                        Tema</label>
                                    <input type="text" class="form-control mb-3" name="jenis_tema" id="jenis_tema"
                                        required>
                                </div>
                                <div class="col-8">
                                    <label for="exampleFormControlInput1" class="form-label">Judul
                                        Materi</label>
                                    <input type="text" class="form-control mb-3" name="judul_materi"
                                        id="judul_materi" required>
                                </div>
                            </div>
                            <label for="exampleFormControlInput1" class="form-label">Link Materi</label>
                            <input type="text" class="form-control mb-3" name="link_materi" id="link_materi"
                                required>
                            <label for="exampleFormControlInput1" class="form-label">Gambar Cover</label>
                            <input type="text" class="form-control mb-3" name="gambar_cover" id="gambar_cover"
                                required>
                            <label for="exampleFormControlInput1" class="form-label">Gambar Materi</label>
                            <input type="text" class="form-control mb-3" name="gambar_materi" id="gambar_materi"
                                required>
                        </div>
                </div>
                <div class="modal-footer">
                    <div id="loading" style="display: none;">
                        Loading...
                    </div>
                    <button type="submit" id="kirimButton" class="btn btn-success">Simpan Data</button>
                </div>
                </form>
            </div>
        </div>
    </div> --}}


    {{-- <div class="modal" tabindex="-1" role="dialog" id="hasilModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Hasil Kirim Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Isi pesan hasil di sini -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div> --}}
@endsection
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var kirimButton = document.getElementById("kirimButton");
        var loadingSpinner = document.getElementById("loading");
        // var hasilModal = document.getElementById("hasilModal");
        // var mainModal = document.

        kirimButton.addEventListener("click", function() {
            // Sembunyikan tombol "Kirim" saat diklik
            kirimButton.style.display = "none";
            // Tampilkan loading spinner saat diklik
            loadingSpinner.style.display = "block";

            // // Simulasi pengiriman data (contoh: delay 2 detik)
            // setTimeout(function() {
            //     // Semua pemrosesan selesai, tampilkan modal hasil
            //     loadingSpinner.style.display = "none";
            //     hasilModal.style.display = "block";
            //     // Isi pesan hasil di dalam modal
            //     var modalBody = hasilModal.querySelector(".modal-body");
            //     modalBody.textContent = "Data berhasil dikirim!";
            // }, 2000);
        });


    });
</script>
