<!-- Kumpulan Modal -->
<!-- Modal Tambah Materi -->
<div class="modal fade" id="addPR" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel"> Tambahkan Data Tugas Rumah </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="form-hapus" action="{{ route('hapusMateri') }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <input type="hidden" class="form-control mb-3" name="id" id="idMateriHap" required>
                        <label for="exampleFormControlInput1" class="form-label">Judul Tugas Rumah</label>
                        <input type="text" class="form-control mb-3" name="judulPr" id="judulPr" required>
                        <label for="exampleFormControlInput1" class="form-label">Deskripsi</label>
                        <input type="text" class="form-control mb-3" name="deskripsi" id="deskripsi" required>
                        <label for="exampleFormControlInput1" class="form-label">Jenis Tema</label>
                        <input type="text" class="form-control mb-3" name="jenis_tema" id="jenisTemaEdit" required>
                        <label for="exampleFormControlInput1" class="form-label">Status</label>
                        <input type="text" class="form-control mb-3" name="gambar_cover" id="gamTemaHap" required>
                    </div>
            </div>
            <div class="modal-footer">
                <div id="loading-hapus" style="display: none;">
                    <button class="btn btn-primary" type="button" disabled>
                        <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
                        <span role="status">Loading...</span>
                    </button>
                </div>
                <button type="submit" id="hapus-data" class="btn btn-success">Simpan Data</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit Materi -->
<div class="modal fade" id="editMateri" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel"></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="form-edit">
                    @csrf
                    <div class="mb-3">
                        <input type="hidden" class="form-control mb-3" name="id_materi" id="idMatEdit" required>
                        <div class="col-4">
                            <label for="exampleFormControlInput1" class="form-label">Jenis Tema</label>
                            <input type="text" class="form-control mb-3" name="jenis_tema" id="jenisTemaEdit"
                                required>
                        </div>
                        <div class="col-8">
                            <label for="exampleFormControlInput1" class="form-label">Kode Kelas</label>
                            <input type="text" class="form-control mb-3" name="judul_materi" id="judulTemaEdit"
                                required>
                        </div>
                        <label for="exampleFormControlInput1" class="form-label">Link Materi</label>
                        <input type="text" class="form-control mb-3" name="link_materi" id="linkTemaEdit" required>
                        <label for="exampleFormControlInput1" class="form-label">Gambar Cover</label>
                        <input type="text" class="form-control mb-3" name="gambar_cover" id="gamCovEdit"
                            required>
                        <label for="exampleFormControlInput1" class="form-label">Gambar Materi</label>
                        <input type="text" class="form-control mb-3" name="gambar_materi" id="gamMatEdit"
                            required>
                    </div>
            </div>
            <div class="modal-footer">
                <div id="loading-edit" style="display: none;">
                    <button class="btn btn-primary" type="button" disabled>
                        <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
                        <span role="status">Loading...</span>
                    </button>
                </div>
                <button type="submit" id="simpanEdit" class="btn btn-success simpanEdit">Simpan Data</button>
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
                <h1 class="modal-title fs-5" id="exampleModalLabel">
                </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="form-hapus" action="{{ route('hapusMateri') }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <input type="hidden" class="form-control mb-3" name="id" id="idMateriHap" required>
                        <div class="row">
                            <div class="col-4">
                                <label for="exampleFormControlInput1" class="form-label">Judul Tugas Rumah</label>
                                <input type="text" class="form-control mb-3" name="judulPr" id="judulPr"
                                    required disabled>
                            </div>
                            <div class="col-8">
                                <label for="exampleFormControlInput1" class="form-label">Deskripsi</label>
                                <input type="text" class="form-control mb-3" name="deskripsi" id="deskripsi"
                                    required disabled>
                            </div>
                        </div>
                        <label for="exampleFormControlInput1" class="form-label">Link
                            Materi</label>
                        <input type="text" class="form-control mb-3" name="link_materi" id="linkTemaHap" required
                            disabled>
                        <label for="exampleFormControlInput1" class="form-label">Gambar
                            Cover</label>
                        <input type="text" class="form-control mb-3" name="gambar_cover" id="gamTemaHap" required
                            disabled>
                        <label for="exampleFormControlInput1" class="form-label">Gambar
                            Materi</label>
                        <input type="text" class="form-control mb-3" name="gambar_materi" id="gamMatHap" required
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
                <button type="submit" id="hapus-data" class="btn btn-danger">Hapus Data</button>
            </div>
            </form>
        </div>
    </div>
</div>
