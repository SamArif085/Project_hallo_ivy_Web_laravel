    <!-- Kumpulan Modal -->
    <!-- Modal Tambah Guru -->
    <div class="modal fade" id="tambahGuru" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">{{ $modal['tambah'] }}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="form-tambah-guru">
                        @csrf
                        <label for="exampleFormControlInput1" class="form-label">Nama Guru</label>
                        <input type="text" class="form-control mb-3" name="namaTambahGuru" id="namaTambahGuru"
                            required>
                        <input type="hidden" class="form-control mb-3" name="kodeKelasTambahGuru"
                            id="kodeKelasTambahGuru" required value="{{ $kd_kls }}">
                        <div class="">
                            <label for="exampleFormControlInput1" class="form-label">Jenis Kelamin</label>
                            <select class="form-select" aria-label="Default select example" name="jenisKelaminGuru"
                                id="jenisKelaminGuru">
                                <option selected>Pilihan</option>
                                <option value="lk">Laki-Laki</option>
                                <option value="prp">Perempuan</option>
                                {{-- <option value="3">Three</option> --}}
                            </select>
                        </div>
                        {{-- <div class="row">

                            <div class="col-8"> --}}
                        {{-- <label for="exampleFormControlInput1" class="form-label">Kode Kelas</label> --}}
                        {{-- <input type="text" class="form-control mb-3" required> --}}
                        {{-- <select class="form-select" aria-label="Default select example"
                                    name="kodeKelasTambahGuru" id="kodeKelasTambahGuru">
                                    <option selected>Pilihan</option> --}}
                        {{-- @foreach ($kodeKelas as $kel => $kelas) --}}
                        {{-- <option value="{{ $kelas->kode_kelas }}"> --}}
                        {{-- {{ $kelas->kode_kelas }} - {{ $kelas->ket_kelas }}</option>
                                    @endforeach --}}
                        {{-- </select>
                            </div> --}}
                        {{-- </div> --}}
                        <div class="row">
                            <div class="col-6">
                                <label for="exampleFormControlInput1" class="form-label">Username</label>
                                <input type="text" class="form-control mb-3" name="usernameTambahGuru"
                                    id="usernameTambahGuru" required>
                            </div>
                            <div class="col-6">
                                <label for="exampleFormControlInput1" class="form-label">Password</label>
                                <input type="text" class="form-control mb-3" name="passwordTambahGuru"
                                    id="passwordTambahGuru" required>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <div id="loading-tambah-guru" style="display: none;">
                        <button class="btn btn-primary" type="button" disabled>
                            <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
                            <span role="status">Loading...</span>
                        </button>
                    </div>
                    <button type="button" class="btn btn-success" id="simpan-data-guru">Simpan Data</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Ubah Guru -->
    <div class="modal fade" id="ubahGuru" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">{{ $modal['tambah'] }}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="form-ubah-guru">
                        @csrf
                        <input type="hidden" class="form-control mb-3" name="idUbahGuru" id="idUbahGuru" required>
                        <input type="hidden" class="form-control mb-3" name="idUbahDetailGuru" id="idUbahDetailGuru" required>
                        <label for="exampleFormControlInput1" class="form-label">Nama Guru</label>
                        <input type="text" class="form-control mb-3" name="namaUbahGuru" id="namaUbahGuru" required>

                        <!-- Jenis Kelamin Dan Kelas Lama -->
                        {{-- <label for="exampleFormControlInput1" class="form-label">Data Lama</label> --}}
                        <div class="row">
                            <div class="col-5">
                                <label for="exampleFormControlInput1" class="form-label">Jenis Kelamin Lama</label>
                                <input type="text" class="form-control mb-3" name="jenisKela" id="jenisKela" required
                                    readonly>
                                <input type="hidden" class="form-control mb-3" name="jenisKelaUbahGuruLama"
                                    id="jenisKelaUbahGuruLama" required readonly>
                            </div>
                            <div class="col-7">
                                <label for="exampleFormControlInput1" class="form-label">Kode Kelas Lama</label>
                                <input type="text" class="form-control mb-3" name="ketKodeKelas"
                                    id="ketKodeKelas" required readonly>
                                <input type="hidden" class="form-control mb-3" name="kodeKelasUbahGuruLama"
                                    id="kodeKelasUbahGuruLama" required readonly>
                            </div>
                        </div>

                        <!-- Jenis Kelamin Dan Kelas Baru -->
                        <div class="row mb-3">
                            <div class="col-5">
                                <label for="exampleFormControlInput1" class="form-label">Jenis Kelamin Baru</label>
                                <select class="form-select" aria-label="Default select example"
                                    name="jenisKelaUbahGuruBaru" id="jenisKelaUbahGuruBaru">
                                    <option value="null" selected>Pilihan</option>
                                    <option value="lk">Laki-Laki</option>
                                    <option value="prp">Perempuan</option>
                                    {{-- <option value="3">Three</option> --}}
                                </select>
                            </div>
                            <div class="col-7">
                                <label for="exampleFormControlInput1" class="form-label">Kode Kelas Baru</label>
                                {{-- <input type="text" class="form-control mb-3" required> --}}
                                <select class="form-select" aria-label="Default select example"
                                    name="kodeKelasUbahGuruBaru" id="kodeKelasUbahGuruBaru">
                                    <option value="null" selected>Pilihan</option>
                                    @foreach ($kodeKelas as $kel => $kelas)
                                        <option value="{{ $kelas->kode_kelas }}">
                                            {{ $kelas->kode_kelas }} - {{ $kelas->ket_kelas }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <label for="exampleFormControlInput1" class="form-label">Username</label>
                                <input type="text" class="form-control mb-3" name="usernameUbahGuru"
                                    id="usernameUbahGuru" required>
                            </div>
                            <div class="col-6">
                                <label for="exampleFormControlInput1" class="form-label">Password</label>
                                <input type="text" class="form-control mb-3" name="passwordUbahGuru"
                                    id="passwordUbahGuru" required>
                                <input type="hidden" class="form-control mb-3" name="passwordUbahGuruLama"
                                    id="passwordUbahGuruLama" required>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <div id="loading-ubah-guru" style="display: none;">
                        <button class="btn btn-primary" type="button" disabled>
                            <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
                            <span role="status">Loading...</span>
                        </button>
                    </div>
                    <button type="button" class="btn btn-success" id="simpan-ubah-guru">Simpan Data</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Ubah Guru -->
    <div class="modal fade" id="hapusGuru" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">{{ $modal['tambah'] }}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="form-hapus-guru">
                        @csrf
                        <input type="hidden" class="form-control mb-3" name="idHapusGuru" id="idHapusGuru"
                            required>
                        <input type="hidden" class="form-control mb-3" name="idHapusDetailGuru" id="idHapusDetailGuru"
                            required>
                        <label for="exampleFormControlInput1" class="form-label">Nama Guru</label>
                        <input type="text" class="form-control mb-3" name="namaHapusGuru" id="namaHapusGuru"
                            required disabled>

                        <!-- Jenis Kelamin Dan Kelas Lama -->
                        {{-- <label for="exampleFormControlInput1" class="form-label">Data Lama</label> --}}
                        <div class="row">
                            <div class="col-5">
                                <label for="exampleFormControlInput1" class="form-label">Jenis Kelamin</label>
                                <input type="text" class="form-control mb-3" name="jenisKelaHapus"
                                    id="jenisKelaHapus" required readonly disabled>
                            </div>
                            <div class="col-7">
                                <label for="exampleFormControlInput1" class="form-label">Kode Kelas</label>
                                <input type="text" class="form-control mb-3" name="ketKodeKelasHapus"
                                    id="ketKodeKelasHapus" required readonly disabled>
                            </div>
                        </div>
                        <div>
                            <label for="exampleFormControlInput1" class="form-label">Username</label>
                            <input type="text" class="form-control mb-3" name="usernameHapusGuru"
                                id="usernameHapusGuru" required disabled>
                        </div>
                        {{-- <div class="row">
                            <div class="col-6">
                                <label for="exampleFormControlInput1" class="form-label">Username</label>
                                <input type="text" class="form-control mb-3" name="usernameUbahGuru"
                                    id="usernameUbahGuru" required>
                            </div> --}}
                        {{-- <div class="col-6">
                                <label for="exampleFormControlInput1" class="form-label">Password</label>
                                <input type="text" class="form-control mb-3" name="passwordUbahGuru"
                                    id="passwordUbahGuru" required>
                                <input type="hidden" class="form-control mb-3" name="passwordUbahGuruLama"
                                    id="passwordUbahGuruLama" required>
                            </div> --}}
                        {{-- </div> --}}
                </div>
                <div class="modal-footer">
                    <div id="loading-hapus-guru" style="display: none;">
                        <button class="btn btn-primary" type="button" disabled>
                            <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
                            <span role="status">Loading...</span>
                        </button>
                    </div>
                    <button type="button" class="btn btn-danger" id="simpan-hapus-guru">Hapus Data</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Detail Guru -->
    <div class="modal fade" id="detailGuru" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">{{ $modal['detail'] }}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        @csrf
                        <label for="exampleFormControlInput1" class="form-label">Nama Guru</label>
                        <input type="text" class="form-control mb-3" name="namaDetailGuru" id="namaDetailGuru"
                            required disabled>
                        <div class="row">
                            <div class="col-4">
                                <label for="exampleFormControlInput1" class="form-label">Kode Kelas</label>
                                <input type="text" class="form-control mb-3" name="kodeKelasDetailGuru"
                                    id="kodeKelasDetailGuru" required disabled>
                            </div>
                            <div class="col-8">
                                <label for="exampleFormControlInput1" class="form-label">Keterangan Kelas</label>
                                <input type="text" class="form-control mb-3" name="ketKelasDetailGuru"
                                    id="ketKelasDetailGuru" required disabled>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <label for="exampleFormControlInput1" class="form-label">Username</label>
                                <input type="text" class="form-control mb-3" name="usernameDetailGuru"
                                    id="usernameDetailGuru" required disabled>
                            </div>
                            <div class="col-6">
                                <label for="exampleFormControlInput1" class="form-label">Password</label>
                                <input type="text" class="form-control mb-3" name="passwordDetailGuru"
                                    id="passwordDetailGuru" required disabled>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
