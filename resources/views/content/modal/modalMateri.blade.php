<!-- Kumpulan Modal -->
<!-- Modal Tambah Materi -->
<div class="modal fade" id="addMateri" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">{{ $modalTitle['materi'] }}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="form_tambah">
                    @csrf
                    <div class="mb-3">
                        <input type="hidden" class="form-control mb-3" name="kodeKelas" id="kodeKelas"
                            value="{{ $kodeKelas }}" placeholder="{{ $kodeKelas }}" required>
                        <div class="row">
                            <div class="col-4">
                                <label for="exampleFormControlInput1" class="form-label">Jenis Tema</label>
                                <input type="text" class="form-control mb-3" name="jenisTemaTam" id="jenisTemaTam"
                                    required>
                            </div>
                            <div class="col-8">
                                <label for="exampleFormControlInput1" class="form-label">Judul Materi</label>
                                <input type="text" class="form-control mb-3" name="judulMatTam" id="judulMatTam"
                                    required>
                            </div>
                        </div>
                        <label for="exampleFormControlInput1" class="form-label">Link Materi</label>
                        <input type="text" class="form-control mb-3" name="linkMatTam" id="linkMatTam" required>
                        <label for="exampleFormControlInput1" class="form-label">Gambar Cover</label>
                        <input type="text" class="form-control mb-3" name="gamCovTam" id="gamCovTam" required>
                        <label for="exampleFormControlInput1" class="form-label">Gambar Materi</label>
                        <input type="text" class="form-control mb-3" name="gamMatTam" id="gamMatTam" required>
                    </div>
            </div>
            <div class="modal-footer">
                <div id="loading-tambah" style="display: none;">
                    <button class="btn btn-primary" type="button" disabled>
                        <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
                        <span role="status">Loading...</span>
                    </button>
                </div>
                <button type="button" id="simpanTambah" class="btn btn-success simpan">Simpan Data</button>
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
                <h1 class="modal-title fs-5" id="exampleModalLabel">{{ $modalTitle['editMateri'] }}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="form-edit">
                    @csrf
                    <div class="mb-3">
                        {{-- <input type="hidden" class="form-control mb-3" name="kode_kelas" id="kode_kelas_edit"
                                value="{{ $kodeKelas }}" placeholder="{{ $kodeKelas }}" required> --}}
                        <input type="hidden" class="form-control mb-3" name="id_materi" id="idMatEdit" required>
                        <div class="row">
                            <div class="col-4">
                                <label for="exampleFormControlInput1" class="form-label">Jenis Tema</label>
                                <input type="text" class="form-control mb-3" name="jenis_tema" id="jenisTemaEdit"
                                    required>
                            </div>
                            <div class="col-8">
                                <label for="exampleFormControlInput1" class="form-label">Judul
                                    Materi</label>
                                <input type="text" class="form-control mb-3" name="judul_materi"
                                    id="judulTemaEdit" required>
                            </div>
                        </div>
                        <label for="exampleFormControlInput1" class="form-label">Link Materi</label>
                        <input type="text" class="form-control mb-3" name="link_materi" id="linkTemaEdit"
                            required>
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
<div class="modal fade" id="deleteMateri" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">
                    {{ $modalTitle['hapusMateri'] }}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="form-hapus" action="{{ route('hapusMateri') }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <input type="hidden" class="form-control mb-3" name="id_materi" id="idMateriHap" required>
                        <input type="hidden" class="form-control mb-3" name="kode_kelas" id="kodKelHap"
                            value="{{ $kodeKelas }}" required>
                        <div class="row">
                            <div class="col-4">
                                <label for="exampleFormControlInput1" class="form-label">Jenis Tema</label>
                                <input type="text" class="form-control mb-3" name="jenis_tema" id="jenisTemaHap"
                                    required disabled>
                            </div>
                            <div class="col-8">
                                <label for="exampleFormControlInput1" class="form-label">Judul
                                    Materi</label>
                                <input type="text" class="form-control mb-3" name="judul_materi"
                                    id="judulTemaHap" required disabled>
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
