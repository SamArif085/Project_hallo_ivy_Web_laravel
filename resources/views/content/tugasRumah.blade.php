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

    </main><!-- End #main -->
    {{--
    <!-- Kumpulan Modal -->
    <!-- Modal Tambah Materi -->
    <div class="modal fade" id="addMateri" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">{{ $modalTitle['materi'] }}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('tambahMateri') }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Pilih Kelas</label>
                            <select class="form-select" id="inputGroupSelect01" name="pilKelas" required>
                                <option selected disabled value="">Pilih Kelas...</option>
                                <option value="1">Kelas Satu</option>
                                <option value="2">Kelas Dua</option>
                                <option value="3">DST</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Pilih Materi Yang Akan Di
                                Upload</label>
                            <div>
                                <button type="button" class="btn btn-warning" onclick="kata()"><i
                                        class="bi bi-fonts"></i></button>
                                <button type="button" class="btn btn-secondary" onclick="gambar()"><i
                                        class="bi bi-image"></i></button>
                                <button type="button" class="btn btn-primary" onclick="video()"><i
                                        class="bi bi-play-btn"></i></button>
                            </div>
                        </div>
                        <div id="formText">
                            <!-- Form dinamis akan ditambahkan di sini -->
                        </div>
                        <div id="formGambar">
                            <!-- Form dinamis akan ditambahkan di sini -->
                        </div>
                        <div id="formVideo">
                            <!-- Form dinamis akan ditambahkan di sini -->
                        </div>
                </div>
                <div class="modal-footer">
                    <!--<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>-->
                    <button type="submit" class="btn btn-success">Simpan Data</button>
                </div>
                </form>
            </div>
        </div>
    </div> --}}
@endsection
{{-- @section('script')
    <script>
        // Function Form Text
        function kata() {
            let data =
                `<label for="exampleFormControlInput1" class="form-label">Deskripsi</label>
                        <div class="row">
                            <div class="col-10">
                                <input type="text" class="form-control mb-3" name="text" id="text" required>
                            </div>
                            <div class="col-2">
                                <button type="button" class="btn btn-danger" onclick="hapus()"><i
                                        class="bi bi-trash"></i></button>
                            </div>
                        </div>`;
            // console.log(data);
            $('#formText').html(data)
        }
        // Function Hapus Form Text
        function hapus() {
            $('#formText').html('')
        }

        // Fucntion Form Gambar
        function gambar() {
            let data =
                `<label for="exampleFormControlInput1" class="form-label">Upload Gambar</label>
                        <div class="row">
                            <div class="col-10">
                                <input type="file" class="form-control mb-3" name="text" id="text" required>
                            </div>
                            <div class="col-2">
                                <button type="button" class="btn btn-danger" onclick="hapusGam()"><i
                                        class="bi bi-trash"></i></button>
                            </div>
                        </div>`;
            // console.log(data);
            $('#formGambar').html(data)
        }

        // Function Hapus Form Gambar
        function hapusGam() {
            $('#formGambar').html('')
        }

        // Function Form Video
        function video() {
            let data =
                `<label for="exampleFormControlInput1" class="form-label">Upload Video</label>
                <div class="row">
                    <div class="col-10">
                        <input type="file" class="form-control mb-3" name="text" id="text" required>
                    </div>
                    <div class="col-2">
                        <button type="button" class="btn btn-danger" onclick="hapusVid()"><i
                                class="bi bi-trash"></i></button>
                    </div>
                </div>`;
            // console.log(data);
            $('#formVideo').html(data)
        }

        // Function Hapus Form Video
        function hapusVid() {
            $('#formVideo').html('')
        }
    </script>
@endsection --}}
