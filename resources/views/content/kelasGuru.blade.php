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

                            <!-- Table with stripped rows -->
                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Kode Kelas</th>
                                        <th scope="col">Keterangan Kelas</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr scope="row">
                                        <?php
                                            $no = 1;
                                            foreach($kelas as $key => $row) {
                                        ?>
                                        <td><?= $no++ ?></td>
                                        <td><?= $row->kode_kelas ?></td>
                                        <td><?= $row->ket_kelas ?></td>
                                        <td>
                                            <a style="text-decoration-style: none"
                                                href="{{ route('dataGuru', ['kode_kls' => base64_encode($row->kode_kelas)]) }}"
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
