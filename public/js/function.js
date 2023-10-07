$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
});

// Function CRUD Materi
// Simpan Tambah Data
$("#simpanTambah").click(function (e) {
    e.preventDefault();

    let form = $("#form_tambah").serialize();

    var jenisTema = $("#jenisTemaTam").val();
    var judulTema = $("#judulMatTam").val();
    var linkMat = $("#linkMatTam").val();
    var gamCov = $("#gamCovTam").val();
    var gamMat = $("#gamMatTam").val();

    $.ajax({
        type: "POST",
        url: "/createTema",
        data: form,
        dataType: "JSON",
        beforeSend: function () {
            $("#simpanTambah").hide();
            $("#loading-tambah").show();
        }, //menampilkan loading saat mengirimkan data
        success: function (response) {
            $("#addMateri").hide();

            Swal.fire({
                type: "success",
                icon: "success",
                title: `${response.message}`,
                showConfirmButton: false,
                timer: 3000,
            }).then((result) => location.reload());
        },
        error: function (xhr, ajaxOptions, thrownError) {
            $("#simpanTambah").show();
            $("#loading-tambah").hide();
            if (jenisTema == "") {
                Swal.fire({
                    type: "error",
                    icon: "error",
                    title: `${xhr.status}`,
                    text: "Jenis Tema Harap Diisi !!!",
                    showConfirmButton: true,
                });
            }
            if (judulTema == "") {
                Swal.fire({
                    type: "error",
                    icon: "error",
                    title: `${xhr.status}`,
                    text: "Judul Materi Harap Diisi !!!",
                    showConfirmButton: true,
                });
            }
            if (linkMat == "") {
                Swal.fire({
                    type: "error",
                    icon: "error",
                    title: `${xhr.status}`,
                    text: "Link Materi Harap Diisi !!!",
                    showConfirmButton: true,
                });
            }
            if (gamCov == "") {
                Swal.fire({
                    type: "error",
                    icon: "error",
                    title: `${xhr.status}`,
                    text: "Gambar Cover Harap Diisi !!!",
                    showConfirmButton: true,
                });
            }
            if (gamMat == "") {
                Swal.fire({
                    type: "error",
                    icon: "error",
                    title: `${xhr.status}`,
                    text: "Gambar Tema Harap Diisi !!!",
                    showConfirmButton: true,
                });
            }
            // Swal.fire({
            //     type: "error",
            //     icon: "error",
            //     title: `${xhr.status}`,
            //     text: "Semua Bidang Harap Diisi !!!",
            //     showConfirmButton: true,
            //     // location: reload,
            //     // timer: 1500
            // });
            // .then((result) =>
            //     location.reload()
            // );
            // alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        },
    });
});

// Simpan Ubah Data
$("body").on("click", "#btn-edit-materi", function () {
    let id = $(this).data("id");
    // console.log(id);

    $.ajax({
        type: "GET",
        url: `/detailShow/${id}`,
        // data: "data",
        // cache: false,
        beforeSend: function () {
            Swal.fire({
                position: "center",
                title: "Proses ambil data . . .",
                allowOutsideClick: false,
                showConfirmButton: false,
                // toast: true,
                html: '<div class="spinner-grow text-primary" role="status"><span class = "visually-hidden" > Proses ambil data . . . < /span></div>',
                timer: 2000,
            });
        },
        success: function (response) {
            $("#idMatEdit").val(response.idMateri);
            $("#jenisTemaEdit").val(response.jenisTema);
            $("#judulTemaEdit").val(response.judulMateri);
            $("#linkTemaEdit").val(response.linkMateri);
            $("#gamCovEdit").val(response.gambarCover);
            $("#gamMatEdit").val(response.gambarMateri);

            // console.log(idMateri);
            $("#editMateri").modal("show");
        },
    });
});
$("#simpanEdit").click(function (e) {
    e.preventDefault();

    let form = $("#form-edit").serialize();

    $.ajax({
        type: "POST",
        url: "/updateTema",
        data: form,
        dataType: "JSON",
        beforeSend: function () {
            $(".simpanEdit").hide();
            $("#loading-edit").show();
        }, //menampilkan loading saat mengirimkan data
        success: function (response) {
            $("#editMateri").hide();
            Swal.fire({
                type: "success",
                icon: "success",
                title: `${response.message}`,
                showConfirmButton: false,
                timer: 3000,
            }).then((result) => location.reload());
        },
        error: function (xhr, ajaxOptions, thrownError) {
            $("#loading-edit").hide();
            $(".simpanEdit").show();
            Swal.fire({
                type: "error",
                icon: "error",
                title: `${xhr.status}`,
                showConfirmButton: true,
                // location: reload,
                // timer: 1500
            });
            // .then((result) =>
            //     location.reload()
            // );
        },
        // complete function
        // complete: function() {
        //     $(".alert").hide();
        // }
    });
});

// Hapus Data Materi
$("body").on("click", "#btn-hapus-materi", function () {
    let id = $(this).data("id");
    // console.log(id);

    $.ajax({
        type: "GET",
        url: `/detailShow/${id}`,
        beforeSend: function () {
            Swal.fire({
                position: "center",
                title: "Proses ambil data . . .",
                allowOutsideClick: false,
                showConfirmButton: false,
                // toast: true,
                html: '<div class="spinner-grow text-primary" role="status"><span class = "visually-hidden" > Proses ambil data . . . < /span></div>',
                timer: 2000,
            });
        },
        success: function (response) {
            $("#idMateriHap").val(response.idMateri);
            $("#jenisTemaHap").val(response.jenisTema);
            $("#judulTemaHap").val(response.judulMateri);
            $("#linkTemaHap").val(response.linkMateri);
            $("#gamTemaHap").val(response.gambarCover);
            $("#gamMatHap").val(response.gambarMateri);

            // console.log(idMateri);
            $("#deleteMateri").modal("show");
        },
    });
});
$("#hapus-data").click(function (e) {
    e.preventDefault();

    let form = $("#form-hapus").serialize();

    $.ajax({
        type: "POST",
        url: "/deleteTema",
        data: form,
        dataType: "JSON",
        beforeSend: function () {
            $("#hapus-data").hide();
            $("#loading-hapus").show();
        }, //menampilkan loading saat mengirimkan data
        success: function (response) {
            $("#deleteMateri").hide();

            if (response.message) {
                Swal.fire({
                    type: "success",
                    icon: "success",
                    title: `${response.message}`,
                    showConfirmButton: false,
                    timer: 3000,
                }).then((result) => location.reload());
            }
        },
        error: function (xhr, ajaxOptions, thrownError) {
            Swal.fire({
                type: "error",
                icon: "error",
                title: `${xhr.status} <br/> PERINGATAN`,
                showConfirmButton: true,
                // location: reload,
                timer: 1500,
            }).then((result) => location.reload());
        },
    });
});

// Function CRUD Quiz
// Tambah Data
$("#simpanTamQuiz").on("click", function (e) {
    e.preventDefault();

    let data = $("#form-tambah-quiz").serialize();
    let idMateriQuiz = $("#idMateriTambahQuiz").val();
    let perta = $("#quizTambah").val();
    let imageQuiz = $("#imageQuizTambah").val();
    let jawab = $("#jawabTambah").val();

    console.log(data);

    $.ajax({
        type: "POST",
        url: "/createQuiz",
        data: data,
        dataType: "json",
        beforeSend: function () {
            $("#loading-tam-quiz").show();
            $("#simpanTamQuiz").hide();
        },
        success: function (response) {
            Swal.fire({
                position: "center",
                icon: "success",
                title: "Data berhasil ditambahkan",
                showConfirmButton: false,
                timer: 1500,
            });
            $("#form-detail-quiz")[0].reset();
            $("#addQuiz").modal("hide");
            location.reload();
        },
        error: function (xhr, ajaxOptions, thrownError) {
            $("#loading-tam-quiz").hide();
            $("#simpanTamQuiz").show();
            if (perta == "") {
                Swal.fire({
                    type: "error",
                    icon: "error",
                    title: `${xhr.status}`,
                    text: "Pertanyaan Harap Diisi !!!",
                    showConfirmButton: true,
                });
            }
            if (imageQuiz == "") {
                Swal.fire({
                    type: "error",
                    icon: "error",
                    title: `${xhr.status}`,
                    text: "Gambar Harap Diisi !!!",
                    showConfirmButton: true,
                });
            }
            if (jawab == "") {
                Swal.fire({
                    type: "error",
                    icon: "error",
                    title: `${xhr.status}`,
                    text: "Jawaban Harap Diisi !!!",
                    showConfirmButton: true,
                });
            }
        },
    });
});
// Button Detail Quiz
$("body").on("click", "#btn-detail-quiz", function () {
    let id = $(this).data("id");
    console.log(id);

    $.ajax({
        type: "GET",
        url: `/detailDataQuiz/${id}`,
        // data: "data",
        // cache: false,
        beforeSend: function () {
            // $("#loading-detail-quiz").show();
            // $("#form-detail-quiz").hide();
            Swal.fire({
                position: "center",
                title: "Proses ambil data . . .",
                allowOutsideClick: false,
                showConfirmButton: false,
                // toast: true,
                html: '<div class="spinner-grow text-primary" role="status"><span class = "visually-hidden" > Proses ambil data . . . < /span></div>',
                timer: 2000,
            });
        },
        success: function (response) {
            // $('#idQuiz').val(response.idQuiz);
            $("#pertaDetail").val(response.perta);
            $("#imageQuizDetail").val(response.imageQuiz);
            // console.log(pert);
            $("#detailQuiz").modal("show");
        },
    });
});

// Fungsi Ubah Data Quiz
$("body").on("click", "#btn-edit-quiz", function () {
    let id = $(this).data("id");
    // console.log(id);

    $.ajax({
        type: "GET",
        url: `/detailDataQuiz/${id}`,
        // data: "data",
        cache: false,
        beforeSend: function () {
            // $("#loading-detail-quiz").show();
            // $("#form-detail-quiz").hide();
            Swal.fire({
                position: "center",
                title: "Proses ambil data . . .",
                allowOutsideClick: false,
                showConfirmButton: false,
                // toast: true,
                html: '<div class="spinner-grow text-primary" role="status"><span class = "visually-hidden" ></span></div>',
                timer: 2000,
            });
        },
        success: function (response) {
            $("#idQuizEdit").val(response.idQuiz);
            $("#quizEdit").val(response.perta);
            $("#imageQuizEdit").val(response.imageQuiz);

            if (response.idJawab == 1) {
                let jawab =
                    `<label for="exampleFormControlInput1" class="form-label">Jawaban</label>
                                    <select class="form-select" name="jawabEditQuiz" id="jawabEditQuiz" aria-label="Default select example">
                                        <option value="` +
                    response.idJawab +
                    `" selected> Betul </option>
                                        <option value="2"> Salah </option>
                                    </select>`;
                $("#formJawabEdit").html(jawab);
            } else if (response.idJawab == 2) {
                let jawab =
                    `<label for="exampleFormControlInput1" class="form-label">Jawaban</label>
                                    <select class="form-select" name="jawabEditQuiz" id="jawabEditQuiz" aria-label="Default select example">
                                        <option value="1"> Betul </option>
                                        <option value="` +
                    response.idJawab +
                    `" selected> Salah </option>
                                    </select>`;
                $("#formJawabEdit").html(jawab);
            }

            // console.log(idMateri);
            $("#editQuiz").modal("show");
        },
    });
});
$("#simpanEditQuiz").on("click", function (e) {
    let form = $("#form-edit-quiz").serialize();

    // console.log(form);
    $.ajax({
        type: "POST",
        url: "/updateQuiz",
        data: form,
        dataType: "JSON",
        beforeSend: function () {
            $("#simpanEditQuiz").hide();
            $("#loading-edit-quiz").show();
        }, //menampilkan loading saat mengirimkan data
        success: function (response) {
            $("#editQuiz").hide();
            Swal.fire({
                type: "success",
                icon: "success",
                title: `${response.message}`,
                showConfirmButton: false,
                timer: 3000,
            }).then((result) => location.reload());
        },
        error: function (xhr, ajaxOptions, thrownError) {
            $("#loading-edit-quiz").hide();
            $("#simpanEditQuiz").show();
            Swal.fire({
                type: "error",
                icon: "error",
                title: `${xhr.status}`,
                showConfirmButton: true,
                // location: reload,
                // timer: 1500
            });
            // .then((result) =>
            //     location.reload()
            // );
        },
        // complete function
        // complete: function() {
        //     $(".alert").hide();
        // }
    });
});

// Fungsi Hapus Data Quiz
$("body").on("click", "#btn-hapus-quiz", function () {
    let id = $(this).data("id");
    // console.log(id);

    $.ajax({
        type: "GET",
        url: `/detailDataQuiz/${id}`,
        // data: "data",
        cache: false,
        beforeSend: function () {
            Swal.fire({
                position: "center",
                title: "Proses ambil data . . .",
                allowOutsideClick: false,
                showConfirmButton: false,
                html: '<div class="spinner-grow text-primary" role="status"><span class = "visually-hidden" ></span></div>',
                timer: 2000,
            });
        },
        success: function (response) {
            $("#idQuizHapus").val(response.idQuiz);
            $("#quizHapus").val(response.perta);
            $("#imageQuizHapus").val(response.imageQuiz);

            if (response.idJawab == 1) {
                let jawab =
                    `<label for="exampleFormControlInput1" class="form-label">Jawaban</label>
                                    <select disabled class="form-select" name="jawabHapusQuiz" id="jawabHapusQuiz" aria -
                                        label="Default select example">
                                        <option value="` +
                    respone.idJawab +
                    `" selected> Betul </option>
                                        <option value="2"> Salah </option>
                                    </select>`;
                $("#formHapusJawabQuiz").html(jawab);
            }
            if (response.idJawab == 2) {
                let jawab =
                    `<label for="exampleFormControlInput1" class="form-label">Jawaban</label>
                                    <select disabled class="form-select" name="jawabHapusQuiz" id="jawabHapusQuiz" aria -
                                        label="Default select example">
                                        <option value="1"> Betul </option>
                                        <option value="` +
                    response.idJawab +
                    `" selected> Salah </option>
                                    </select>`;
                $("#formHapusJawabQuiz").html(jawab);
            }

            $("#hapusQuiz").modal("show");
        },
    });
});
$("#simpanHapusQuiz").on("click", function (e) {
    let form = $("#form-hapus-quiz").serialize();

    $.ajax({
        type: "POST",
        url: "/deleteQuiz",
        data: form,
        dataType: "JSON",
        beforeSend: function () {
            $("#simpanHapusQuiz").hide();
            $("#loading-hapus-quiz").show();
        }, //menampilkan loading saat mengirimkan data
        success: function (response) {
            $("#hapusQuiz").hide();
            Swal.fire({
                type: "success",
                icon: "success",
                title: `${response.message}`,
                showConfirmButton: false,
                timer: 3000,
            }).then((result) => location.reload());
        },
        error: function (xhr, ajaxOptions, thrownError) {
            $("#loading-hapus-quiz").hide();
            $("#simpanHapusQuiz").show();
            Swal.fire({
                type: "error",
                icon: "error",
                title: `${xhr.status}`,
                showConfirmButton: true,
                location: reload,
                timer: 1500,
            });
        },
    });
});

// Function CRUD Admin Data Guru
// Tambah Guru
$("#simpan-data-guru").on("click", function (e) {
    e.preventDefault();

    var nama = $("#namaTambahGuru").val();
    var jenisKelamin = $("#jenisKelaminGuru").val();
    var kodeKelas = $("#kodeKelasTambahGuru").val();
    var username = $("#usernameTambahGuru").val();
    var password = $("#passwordTambahGuru").val();

    var data = $("#form-tambah-guru").serialize();
    $.ajax({
        type: "POST",
        url: "/createGuru",
        data: data,
        dataType: "JSON",
        beforeSend: function () {
            $("#loading-tambah-guru").show();
            $("#simpan-data-guru").hide();
        },
        success: function (response) {
            $("#tambahGuru").hide();

            Swal.fire({
                type: "success",
                icon: "success",
                title: `${response.message}`,
                showConfirmButton: false,
                timer: 3000,
            }).then((result) => location.reload());
        },
        error: function (xhr, ajaxOptions, thrownError) {
            $("#loading-tambah-guru").hide();
            $("#simpan-data-guru").show();

            if (nama === "") {
                Swal.fire({
                    type: "error",
                    icon: "error",
                    title: `${xhr.status}`,
                    text: "Nama Guru Harap Diisi !!!",
                    showConfirmButton: true,
                });
            }
            if (jenisKelamin === "") {
                Swal.fire({
                    type: "error",
                    icon: "error",
                    title: `${xhr.status}`,
                    text: "Jenis Kelamin Guru Harap Dipilih !!!",
                    showConfirmButton: true,
                });
            }
            if (kodeKelas === "") {
                Swal.fire({
                    type: "error",
                    icon: "error",
                    title: `${xhr.status}`,
                    text: "Kelas Guru Harap Dipilih !!!",
                    showConfirmButton: true,
                });
            }
            if (username === "") {
                Swal.fire({
                    type: "error",
                    icon: "error",
                    title: `${xhr.status}`,
                    text: "Username Guru Harap Diisi !!!",
                    showConfirmButton: true,
                });
            }
            if (password === "") {
                Swal.fire({
                    type: "error",
                    icon: "error",
                    title: `${xhr.status}`,
                    text: "Password Guru Harap Diisi !!!",
                    showConfirmButton: true,
                });
            }
        },
    });
});

// Detail Guru
$("body").on("click", "#btn-detail-guru", function (e) {
    e.preventDefault();

    let id = $(this).data("id");

    $.ajax({
        type: "GET",
        url: `detailGuru/${id}`,
        // data: "data",
        // dataType: "dataType",
        beforeSend: function () {
            Swal.fire({
                position: "center",
                title: "Proses ambil data . . .",
                allowOutsideClick: false,
                showConfirmButton: false,
                // toast: true,
                html: '<div class="spinner-grow text-primary" role="status"><span class = "visually-hidden" > Proses ambil data . . . < /span></div>',
                timer: 2000,
            });
        },
        success: function (response) {
            $("#namaDetailGuru").val(response.namaGuru);
            $("#kodeKelasDetailGuru").val(response.kodeKelas);
            $("#ketKelasDetailGuru").val(response.ketKelas);
            $("#usernameDetailGuru").val(response.username);
            // $('#passwordDetailGuru').val(response.password)

            $("#detailGuru").modal("show");
        },
    });
});

// Ubah Guru
$("body").on("click", "#btn-ubah-guru", function (e) {
    e.preventDefault();

    let id = $(this).data("id");

    $.ajax({
        type: "GET",
        url: `detailGuru/${id}`,
        // data: "data",
        // dataType: "dataType",
        beforeSend: function () {
            Swal.fire({
                position: "center",
                title: "Proses ambil data . . .",
                allowOutsideClick: false,
                showConfirmButton: false,
                // toast: true,
                html: '<div class="spinner-grow text-primary" role="status"><span class = "visually-hidden" > Proses ambil data . . . < /span></div>',
                timer: 2000,
            });
        },
        success: function (response) {
            $("#idUbahGuru").val(response.idGuru);
            $("#namaUbahGuru").val(response.namaGuru);
            $("#ketKodeKelas").val(
                response.kodeKelas + ` - ` + response.ketKelas
            );
            $("#kodeKelasUbahGuruLama").val(response.kodeKelas);
            // $('#ketKelasDetailGuru').val(response.ketKelas)
            $("#usernameUbahGuru").val(response.username);
            $("#jenisKela").val(response.jeKal);
            $("#jenisKelaUbahGuruLama").val(response.idJeKal);
            $("#passwordUbahGuruLama").val(response.password);

            $("#ubahGuru").modal("show");
        },
    });
});
$("#simpan-ubah-guru").on("click", function () {
    var data = $("#form-ubah-guru").serialize();
    // console.log(data);
    $.ajax({
        type: "POST",
        url: "/updateGuru",
        data: data,
        // dataType: "dataType",
        beforeSend: function () {
            $("#loading-ubah-guru").show();
            $("#simpan-ubah-guru").hide();
        },
        success: function (response) {
            $("#ubahGuru").hide();

            Swal.fire({
                type: "success",
                icon: "success",
                title: `${response.message}`,
                showConfirmButton: false,
                timer: 3000,
            }).then((result) => location.reload());
        },
        error: function (xhr, ajaxOptions, thrownError) {
            $("#loading-edit").hide();
            $(".simpanEdit").show();
            Swal.fire({
                type: "error",
                icon: "error",
                title: `${xhr.status}`,
                showConfirmButton: true,
                // location: reload,
                // timer: 1500
            });
        },
    });
});

// Hapus Guru
$("body").on("click", "#btn-hapus-guru", function (e) {
    e.preventDefault();

    let id = $(this).data("id");

    $.ajax({
        type: "GET",
        url: `detailGuru/${id}`,
        // data: "data",
        // dataType: "dataType",
        beforeSend: function () {
            Swal.fire({
                position: "center",
                title: "Proses ambil data . . .",
                allowOutsideClick: false,
                showConfirmButton: false,
                // toast: true,
                html: '<div class="spinner-grow text-primary" role="status"><span class = "visually-hidden" > Proses ambil data . . . < /span></div>',
                timer: 2000,
            });
        },
        success: function (response) {
            $("#idHapusGuru").val(response.idGuru);
            $("#namaHapusGuru").val(response.namaGuru);
            $("#ketKodeKelasHapus").val(
                response.kodeKelas + ` - ` + response.ketKelas
            );
            // $('#kodeKelasUbahGuruLama').val(response.kodeKelas)
            // $('#ketKelasDetailGuru').val(response.ketKelas)
            $("#usernameHapusGuru").val(response.username);
            $("#jenisKelaHapus").val(response.jeKal);
            // $('#jenisKelaUbahGuruLama').val(response.idJeKal)
            // $('#passwordUbahGuruLama').val(response.password)

            $("#hapusGuru").modal("show");
        },
    });
});
$("#simpan-hapus-guru").on("click", function () {
    var data = $("#form-hapus-guru").serialize();
    // console.log(data);
    $.ajax({
        type: "POST",
        url: "/deleteGuru",
        data: data,
        // dataType: "dataType",
        beforeSend: function () {
            $("#loading-hapus-guru").show();
            $("#simpan-hapus-guru").hide();
        },
        success: function (response) {
            $("#hapusGuru").hide();

            Swal.fire({
                type: "success",
                icon: "success",
                title: `${response.message}`,
                showConfirmButton: false,
                timer: 3000,
            }).then((result) => location.reload());
        },
        error: function (xhr, ajaxOptions, thrownError) {
            $("#loading-edit").hide();
            $(".simpanEdit").show();
            Swal.fire({
                type: "error",
                icon: "error",
                title: `${xhr.status}`,
                showConfirmButton: true,
                // location: reload,
                // timer: 1500
            });
        },
    });
});
