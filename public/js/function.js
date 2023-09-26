$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
});

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
                    // location: reload,
                    // timer: 1500
                });
            }
            if (judulTema == "") {
                Swal.fire({
                    type: "error",
                    icon: "error",
                    title: `${xhr.status}`,
                    text: "Judul Materi Harap Diisi !!!",
                    showConfirmButton: true,
                    // location: reload,
                    // timer: 1500
                });
            }
            if (linkMat == "") {
                Swal.fire({
                    type: "error",
                    icon: "error",
                    title: `${xhr.status}`,
                    text: "Link Materi Harap Diisi !!!",
                    showConfirmButton: true,
                    // location: reload,
                    // timer: 1500
                });
            }
            if (gamCov == "") {
                Swal.fire({
                    type: "error",
                    icon: "error",
                    title: `${xhr.status}`,
                    text: "Gambar Cover Harap Diisi !!!",
                    showConfirmButton: true,
                    // location: reload,
                    // timer: 1500
                });
            }
            if (gamMat == "") {
                Swal.fire({
                    type: "error",
                    icon: "error",
                    title: `${xhr.status}`,
                    text: "Gambar Tema Harap Diisi !!!",
                    showConfirmButton: true,
                    // location: reload,
                    // timer: 1500
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
        // data: "data",
        // cache: false,
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
                title: `${xhr.status}`,
                showConfirmButton: false,
                // location: reload,
                timer: 1500,
            }).then((result) => location.reload());
        },
    });
});
