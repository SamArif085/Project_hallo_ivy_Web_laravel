<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>{{ $title }}</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="/img/favicon.png" rel="icon">
    <link href="/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="/vendor/simple-datatables/style.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="/css/style.css" rel="stylesheet">
</head>

<body>
    @include('layout.headerDetail')
    @include('layout.aside')
    @yield('content')
    @include('layout.footer')
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Vendor JS Files -->
    <script src="/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/vendor/chart.js/chart.umd.js"></script>
    <script src="/vendor/echarts/echarts.min.js"></script>
    <script src="/vendor/quill/quill.min.js"></script>
    <script src="/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="/vendor/tinymce/tinymce.min.js"></script>
    <script src="/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="/js/main.js"></script>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // Simpan Tambah Data
        $('#simpanTambah').click(function(e) {
            e.preventDefault();

            let form = $('#form_tambah').serialize();

            $.ajax({
                type: "POST",
                url: "{{ route('tambahMateri') }}",
                data: form,
                dataType: "JSON",
                beforeSend: function() {
                    $("#simpanTambah").hide();
                    $("#loading-tambah").show();
                }, //menampilkan loading saat mengirimkan data
                success: function(response) {
                    $('#addMateri').hide();

                    Swal.fire({
                        type: 'success',
                        icon: 'success',
                        title: `${response.message}`,
                        showConfirmButton: false,
                        timer: 3000
                    }).then((result) =>
                        location.reload()
                    );
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    $("#simpanTambah").show();
                    $("#loading-tambah").hide();
                    Swal.fire({
                        type: 'error',
                        icon: 'error',
                        title: `${xhr.status}`,
                        text: 'Semua Bidang Harap Diisi !!!',
                        showConfirmButton: true,
                        // location: reload,
                        // timer: 1500
                    });
                    // .then((result) =>
                    //     location.reload()
                    // );
                    // alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });
        });

        // Simpan Ubah Data
        $('body').on('click', '#btn-edit-materi', function() {
            let id = $(this).data('id');
            // console.log(id);

            $.ajax({
                type: "GET",
                url: `/detailShow/${id}`,
                // data: "data",
                // cache: false,
                success: function(response) {
                    $('#idMatEdit').val(response.idMateri);
                    $('#jenisTemaEdit').val(response.jenisTema);
                    $('#judulTemaEdit').val(response.judulMateri);
                    $('#linkTemaEdit').val(response.linkMateri);
                    $('#gamCovEdit').val(response.gambarCover);
                    $('#gamMatEdit').val(response.gambarMateri);

                    // console.log(idMateri);
                    $('#editMateri').modal('show');
                }
            });
        });
        $('#simpanEdit').click(function(e) {
            e.preventDefault();

            let form = $('#form-edit').serialize();

            $.ajax({
                type: "POST",
                url: "{{ route('editMateri') }}",
                data: form,
                dataType: "JSON",
                beforeSend: function() {
                    $(".simpanEdit").hide();
                    $("#loading-edit").show();
                }, //menampilkan loading saat mengirimkan data
                success: function(response) {
                    $('#editMateri').hide();
                    Swal.fire({
                        type: 'success',
                        icon: 'success',
                        title: `${response.message}`,
                        showConfirmButton: false,
                        timer: 3000
                    }).then((result) =>
                        location.reload()
                    );
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    $("#loading-edit").hide();
                    $(".simpanEdit").show();
                    Swal.fire({
                        type: 'error',
                        icon: 'error',
                        title: `${xhr.status}`,
                        showConfirmButton: true,
                        // location: reload,
                        // timer: 1500
                    })
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
        $('body').on('click', '#btn-hapus-materi', function() {
            let id = $(this).data('id');
            // console.log(id);

            $.ajax({
                type: "GET",
                url: `/detailShow/${id}`,
                // data: "data",
                // cache: false,
                success: function(response) {
                    $('#idMateriHap').val(response.idMateri);
                    $('#jenisTemaHap').val(response.jenisTema);
                    $('#judulTemaHap').val(response.judulMateri);
                    $('#linkTemaHap').val(response.linkMateri);
                    $('#gamTemaHap').val(response.gambarCover);
                    $('#gamMatHap').val(response.gambarMateri);

                    // console.log(idMateri);
                    $('#deleteMateri').modal('show');
                }
            });
        });
        $('#hapus-data').click(function(e) {
            e.preventDefault();

            let form = $('#form-hapus').serialize();

            $.ajax({
                type: "POST",
                url: "{{ route('hapusMateri') }}",
                data: form,
                dataType: "JSON",
                beforeSend: function() {
                    $("#hapus-data").hide();
                    $("#loading-hapus").show();
                }, //menampilkan loading saat mengirimkan data
                success: function(response) {
                    $('#deleteMateri').hide();

                    if (response.message) {
                        Swal.fire({
                            type: 'success',
                            icon: 'success',
                            title: `${response.message}`,
                            showConfirmButton: false,
                            timer: 3000
                        }).then((result) =>
                            location.reload()
                        );
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    Swal.fire({
                        type: 'error',
                        icon: 'error',
                        title: `${xhr.status}`,
                        showConfirmButton: false,
                        // location: reload,
                        timer: 1500
                    }).then((result) =>
                        location.reload()
                    );
                },
            });
        });
    </script>

</body>

</html>
