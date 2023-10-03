<!-- Kumpulan Modal -->
<!-- Modal Tambah Quiz -->
<div class="modal fade" id="addQuiz" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">{{ $modalTitle['tambah'] }}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="form-tambah-quiz">
                    @csrf
                    <div class="mb-3">
                        <input type="hidden" class="form-control mb-3" name="idMateriTambahQuiz"
                            id="idMateriTambahQuiz" value="{{ $idMateri }}" required>
                        <div class="row">
                            <div class="col-9">
                                <label for="exampleFormControlInput1" class="form-label">Pertanyaan</label>
                                <input type="text" class="form-control mb-3" name="quizTambah" id="quizTambah"
                                    required>
                            </div>
                            <div class="col-3">
                                <label for="exampleFormControlInput1" class="form-label">Jawaban</label>
                                <select class="form-select" name="jawabTambah" id="jawabTambah"
                                    aria-label="Default select example">
                                    <option selected>Pilih Jawab</option>
                                    <option value="1">Betul</option>
                                    <option value="2">Salah</option>
                                </select>
                            </div>
                        </div>
                        <label for="exampleFormControlInput1" class="form-label">Link Gambar</label>
                        <textarea name="imageQuizTambah" id="imageQuizTambah" cols="10" rows="1" class="form-control mb-3"></textarea>
                    </div>
            </div>
            <div class="modal-footer">
                <div id="loading-tam-quiz" style="display: none;">
                    <button class="btn btn-primary" type="button" disabled>
                        <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
                        <span role="status">Loading...</span>
                    </button>
                </div>
                <button type="button" class="btn btn-success" id="simpanTamQuiz">Simpan Data</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Ubah Quiz -->
<div class="modal fade" id="editQuiz" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">{{ $modalTitle['edit'] }}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="form-edit-quiz">
                    @csrf
                    <div class="mb-3">
                        <input type="hidden" class="form-control mb-3" name="idQuizEdit" id="idQuizEdit" required>
                        <div class="row">
                            <div class="col-9">
                                <label for="exampleFormControlInput1" class="form-label">Pertanyaan</label>
                                <input type="text" class="form-control mb-3" name="quizEdit" id="quizEdit" required>
                            </div>
                            <div class="col-3">
                                <div id="formJawabEdit"></div>
                            </div>
                        </div>
                        <label for="exampleFormControlInput1" class="form-label">Link Gambar</label>
                        <textarea name="imageQuizEdit" id="imageQuizEdit" cols="10" rows="1" class="form-control mb-3"></textarea>
                    </div>
            </div>
            <div class="modal-footer">
                <div id="loading-edit-quiz" style="display: none;">
                    <button class="btn btn-primary" type="button" disabled>
                        <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
                        <span role="status">Loading...</span>
                    </button>
                </div>
                <button type="button" class="btn btn-success" id="simpanEditQuiz">Simpan Data</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Hapus Quiz -->
<div class="modal fade" id="hapusQuiz" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">{{ $modalTitle['hapus'] }}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="form-hapus-quiz">
                    @csrf
                    <div class="mb-3">
                        <input type="hidden" class="form-control mb-3" name="idQuizHapus" id="idQuizHapus"
                            required>
                        <div class="row">
                            <div class="col-9">
                                <label for="exampleFormControlInput1" class="form-label">Pertanyaan</label>
                                <input type="text" class="form-control mb-3" name="quizHapus" id="quizHapus"
                                    required disabled>
                            </div>
                            <div class="col-3">
                                <div id="formHapusJawabQuiz"></div>
                            </div>
                        </div>
                        <label for="exampleFormControlInput1" class="form-label">Link Gambar</label>
                        <textarea name="imageQuizHapus" id="imageQuizHapus" cols="10" rows="1" class="form-control mb-3"
                            disabled></textarea>
                    </div>
            </div>
            <div class="modal-footer">
                <div id="loading-hapus-quiz" style="display: none;">
                    <button class="btn btn-primary" type="button" disabled>
                        <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
                        <span role="status">Loading...</span>
                    </button>
                </div>
                <button type="button" class="btn btn-danger" id="simpanHapusQuiz">Hapus Data</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Detail Quiz -->
<div class="modal fade" id="detailQuiz" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">{{ $modalTitle['detail'] }}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="form-detail-quiz">
                    @csrf
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Pertanyaan</label>
                        <input type="text" class="form-control mb-3" name="perta" id="pertaDetail" required>
                        <label for="exampleFormControlInput1" class="form-label">Link Gambar</label>
                        <textarea name="imageQuiz" id="imageQuizDetail" cols="10" rows="2" class="form-control mb-3"></textarea>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger simpan" data-bs-dismiss="modal">Tutup Modal</button>
            </div>
            </form>
        </div>
    </div>
</div>
