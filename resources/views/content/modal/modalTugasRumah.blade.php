<!-- Kumpulan Modal -->
<!-- Modal Tambah Materi -->
<div class="modal fade" id="addPR" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">{{ $modalTitle['materi'] }}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="form_tambah_PR" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Judul Tugas Rumah</label>
                        <input type="text" class="form-control mb-3" name="judulPr" id="judulPr" required>
                        <label for="exampleFormControlInput1" class="form-label">Deskripsi</label>
                        <input type="text" class="form-control mb-3" name="deskripsi" id="deskripsi" required>
                        <input type="text" class="form-control mb-3" hidden name="status" id="status"
                            value="aktif" required>
                        {{-- <input type="text" class="form-control mb-3" required> --}}
                        <div class="row">
                            <div class="col-6">
                                <label for="exampleFormControlInput1" class="form-label">Tenggat</label>
                                <input type="date" class="form-control mb-3" name="tenggat" id="tenggat" required>
                            </div>
                            <div class="col-6">
                                <label for="exampleFormControlInput1" class="form-label">Kelas</label>
                                <select class="form-select" aria-label="Default select example" name="kodeKelas"
                                    id="kodeKelas">
                                    <option value="null" selected>Pilihan</option>
                                    @foreach ($kode_kelas as $kel => $kelas)
                                        <option value="{{ $kelas->kode_kelas }}">
                                            {{ $kelas->kode_kelas }} - {{ $kelas->ket_kelas }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <div id="loading-tambah" style="display: none;">
                    <button class="btn btn-primary" type="button" disabled>
                        <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
                        <span role="status">Loading...</span>
                    </button>
                </div>
                <button type="button" id="simpanDataPR" class="btn btn-success simpan">Simpan Data</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit Materi -->
<div class="modal fade" id="editPR" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">{{ $modalTitle['editMateri'] }}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="form-edit-PR" method="POST">
                    @csrf
                    <div class="mb-3">
                        <input type="hidden" class="form-control mb-3" name="id" id="idEdit" required>
                        <label for="exampleFormControlInput1" class="form-label">Judul Tugas Rumah</label>
                        <input type="text" class="form-control mb-3" name="judulPr" id="judulPrEdit" required>
                        <label for="exampleFormControlInput1" class="form-label">Deskripsi</label>
                        <input type="text" class="form-control mb-3" name="deskripsi" id="deskripsiEdit" required>
                        <label for="exampleFormControlInput1" class="form-label">Tanggat</label>
                        <input type="date" class="form-control mb-3" name="tenggat" id="tenggatEdit" required>
                        <input type="text" class="form-control mb-3" hidden name="status" id="statusEdit">
                        <div class="row">
                            <div class="col-6">
                                <label for="exampleFormControlInput1" class="form-label">Kelas Lama</label>
                                <input type="text" readonly class="form-control mb-3" name="kode_kelas" id="kode_kelas"
                                    required>
                                <input type="hidden" readonly class="form-control mb-3" name="kodeKelasLama" id="kodeKelasLama"
                                    required>
                            </div>
                            <div class="col-6">
                                <label for="exampleFormControlInput1" class="form-label">Kelas Baru</label>
                                <select class="form-select" aria-label="Default select example" name="kodeKelasBaru"
                                    id="kodeKelasBaru">
                                    <option value="null" selected>Pilihan</option>
                                    @foreach ($kode_kelas as $kel => $kelas)
                                        <option value="{{ $kelas->kode_kelas }}">
                                            {{ $kelas->kode_kelas }} - {{ $kelas->ket_kelas }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <div id="loading-edit" style="display: none;">
                    <button class="btn btn-primary" type="button" disabled>
                        <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
                        <span role="status">Loading...</span>
                    </button>
                </div>
                <button type="submit" id="editDataPR" class="btn btn-success editDataPR">Simpan Data</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal hapus Materi -->
<div class="modal fade" id="hapusPR" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">{{ $modalTitle['hapusMateri'] }}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="hapusDataPR" method="POST">
                    @csrf
                    <div class="mb-3">
                        <input type="hidden" class="form-control mb-3" name="id" id="idHap" required>
                        <label for="exampleFormControlInput1" class="form-label">Judul Tugas Rumah</label>
                        <input type="text" class="form-control mb-3" name="judulPr" id="judulPrHap" required
                            disabled>
                        <label for="exampleFormControlInput1" class="form-label">Deskripsi</label>
                        <input type="text" class="form-control mb-3" name="deskripsi" id="deskripsiHap" required
                            disabled>
                        <label for="exampleFormControlInput1" class="form-label">Tanggat</label>
                        <input type="date" class="form-control mb-3" name="tenggat" id="tenggatHap" required
                            disabled>
                        <input type="hidden" class="form-control mb-3" name="status" id="statusHap" required
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
                <button type="submit" id="hapusPRData" class="btn btn-danger hapusPRData">Hapus Data</button>
            </div>
            </form>
        </div>
    </div>
</div>
