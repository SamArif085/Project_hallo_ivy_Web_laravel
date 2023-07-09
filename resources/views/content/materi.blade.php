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
                                data-bs-target="#addMateri">
                                Tambah Materi
                            </button>
                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addQuiz">
                                Tambah Quiz
                            </button>

                            <!-- Table with stripped rows -->
                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Position</th>
                                        <th scope="col">Age</th>
                                        <th scope="col">Start Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">1</th>
                                        <td>Brandon Jacob</td>
                                        <td>Designer</td>
                                        <td>28</td>
                                        <td>2016-05-25</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">2</th>
                                        <td>Bridie Kessler</td>
                                        <td>Developer</td>
                                        <td>35</td>
                                        <td>2014-12-05</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">3</th>
                                        <td>Ashleigh Langosh</td>
                                        <td>Finance</td>
                                        <td>45</td>
                                        <td>2011-08-12</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">4</th>
                                        <td>Angus Grady</td>
                                        <td>HR</td>
                                        <td>34</td>
                                        <td>2012-06-11</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">5</th>
                                        <td>Raheem Lehner</td>
                                        <td>Dynamic Division Officer</td>
                                        <td>47</td>
                                        <td>2011-04-19</td>
                                    </tr>
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
        <div class="modal-dialog modal-lg">
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
                            <select class="form-select" id="inputGroupSelect01" name="pilKelas">
                                <option selected>Pilih Kelas...</option>
                                <option value="1">Kelas Satu</option>
                                <option value="2">Kelas Dua</option>
                                <option value="3">DST</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Pilih Materi Yang Akan Di
                                Upload</label>
                            <div>
                                <button type="button" class="btn btn-warning" onclick="text()"><i
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
                    {{-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> --}}
                    <button type="submit" class="btn btn-success">Simpan Data</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    input
@endsection
@section('script')
    <script>
        // Function Form Text
        function text() {
            let data =
                `<label for="exampleFormControlInput1" class="form-label">Deskripsi</label>
                <input type="text" class="form-control mb-3" name="text" id="text" required><button type="button" class="btn btn-danger" onclick="hapus()"><i class="bi bi-trash"></i></button>`;
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
                <input type="file" class="form-control mb-3" name="text" id="text" required><button type="button" class="btn btn-danger" onclick="hapusGam()"><i class="bi bi-trash"></i></button>`;
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
                <input type="file" class="form-control mb-3" name="text" id="text" required><button type="button" class="btn btn-danger" onclick="hapusVid()"><i class="bi bi-trash"></i></button>`;
            // console.log(data);
            $('#formVideo').html(data)
        }

        // Function Hapus Form Video
        function hapusVid() {
            $('#formVideo').html('')
        }
        // error handle
        function error() {
            let data =
                `<div class="alert alert-danger" role="alert">
                        Error! Data tidak boleh kosong, silahkan isi form
                    </div>`;
            // console.log(data);
            $('#error').html(data)
        }
        $(document).ready(() => {})
    </script>
@endsection
