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
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">{{ $modalTitle['materi'] }}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Pilih Kelas</label>
                            <select class="form-select" id="inputGroupSelect01">
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
                                <button type="button" class="btn btn-primary"><i class="bi bi-fonts"></i></button>
                                <button type="button" class="btn btn-primary"><i class="bi bi-image"></i></button>
                                <button type="button" class="btn btn-primary"><i class="bi bi-play-btn"></i></button>
                            </div>
                        </div>
                        <div id="formContainer">
                            <!-- Form dinamis akan ditambahkan di sini -->
                        </div>
                </div>
                <div class="modal-footer">
                    {{-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> --}}
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Quiz -->
    <div class="modal fade" id="addQuiz" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">{{ $modalTitle['quiz'] }}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Pilih Materi</label>
                            <select class="form-select" id="inputGroupSelect01">
                                <option selected>Pilih Materi...</option>
                                <option value="1">Materi Satu</option>
                                <option value="2">Materi Dua</option>
                                <option value="3">DST</option>
                            </select>
                        </div>
                        {{-- <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Pilih Materi Yang Akan Di
                                Upload</label>
                            <div>
                                <button type="button" class="btn btn-primary"><i class="bi bi-fonts"></i></button>
                                <button type="button" class="btn btn-primary"><i class="bi bi-image"></i></button>
                                <button type="button" class="btn btn-primary"><i class="bi bi-play-btn"></i></button>
                            </div>
                        </div> --}}
                        <div id="formContainer">
                            <!-- Form dinamis akan ditambahkan di sini -->
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
                </form>
            </div>
        </div>
    </div>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var addFormBtn = document.getElementById('addFormBtn');
            var formContainer = document.getElementById('formContainer');

            addFormBtn.addEventListener('click', function() {
                var formTemplate = document.createElement('div');
                formTemplate.innerHTML = `
                    <input type="text" name="name" placeholder="Nama">
                    <button class="btn-remove">Hapus</button>
                `;

                formContainer.appendChild(formTemplate);
            });

            formContainer.addEventListener('click', function(event) {
                if (event.target.classList.contains('btn-remove')) {
                    event.target.parentNode.remove();
                }
            });
        });
    </script>
@endsection
