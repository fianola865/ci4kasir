<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pelanggan</title>
    <link rel="stylesheet" href="<?=base_url('assets/bootstrap-5.3.3-dist/css/bootstrap.min.css')?>">
    <link rel="stylesheet" href="<?=base_url('assets/fontawesome-free-6.6.0-web/css/all.min.css')?>">
</head>
<body>
<div class="container"><br><br>
        <h3 class="text-center">Data Pelanggan</h3> 
        <button type="button" class="btn btn-success float-end" data-bs-toggle="modal" data-bs-target="#modalTambahPelanggan">Tambah Pelanggan</button><br><br>
        <div class="row">
            <div class="col-12">
                <div class="container mt-5">
                    <table class="table table-bordered" id="pelangganTable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Pelanggan</th>
                                <th>Alamat</th>
                                <th>Nomor Tlp</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="<?=base_url('assets/jquery-3.7.1.min.js')?>"></script>
    <script src="<?=base_url('assets/bootstrap-5.3.3-dist/js/bootstrap.min.js')?>"></script>
    
    <div class="modal fade" id="modalTambahPelanggan" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalTambahPelanggan" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel" style="color: blue;">Tambah Pelanggan</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <form>
                <div class="row mb-3">
                    <label for="NamaPelanggan" class="col-sm-4 col-form-label">Nama Pelanggan</label>
                    <div class="col-sm-8">
                    <input type="text" class="form-control" id="NamaPelanggan">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="Alamat" class="col-sm-4 col-form-label">Alamat</label>
                    <div class="col-sm-8">
                    <input type="text" class="form-control" id="Alamat">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="NomorTlp" class="col-sm-4 col-form-label">Nomor Tlp</label>
                    <div class="col-sm-8">
                    <input type="number" class="form-control" id="NomorTlp">
                    </div>
                </div>
                

                <button type="submit" class="btn btn-primary float-end" id="simpanPelanggan">Simpan</button>
                
                </form>
            </div>
            
            </div>
        </div>
        </div> 
        <div class="modal fade" id="modaleditPelanggan" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modaleditPelanggan" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modaleditPelanggan" style="color: blue;">Edit Pelanggan</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <form id="formeditproduk" >
            <input type="hidden" id="editPelangganId">
                <div class="row mb-3">
                    <label for="NamaPelanggan" class="col-sm-4 col-form-label">Nama Pelanggan</label>
                    <div class="col-sm-8">
                    <input type="text" class="form-control" id="NamaPelanggan">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="Alamat" class="col-sm-4 col-form-label">Alamat</label>
                    <div class="col-sm-8">
                    <input type="text" class="form-control" id="Alamat">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="NomorTlp" class="col-sm-4 col-form-label">Nomor Tlp</label>
                    <div class="col-sm-8">
                    <input type="text" class="form-control" id="NomorTlp">
                    </div>
                </div>
                
                <button type="submit" class="btn btn-primary float-end" id="updatePelanggan">Edit</button>
                
                </form>
            </div>
            
            </div>
        </div>
        </div>
        <script>
            $(document).ready(function(){
                function tampil() {
                    $.ajax({
                        url: '<?=base_url('pelanggan/tampil') ?>',
                        type: 'GET',
                        dataType: 'json',
                        success: function(hasil) {
                            if (hasil.status === 'success') {
                                var pelangganTable = $('#pelangganTable tbody');
                                pelangganTable.empty(); //hapus semua isi 

                                var pelanggan = hasil.pelanggan;
                                var no = 1;

                        
                                pelanggan.forEach(function(item){
                                    var row = '<tr>' +
                                        '<td>' + no + '</td>' +
                                        '<td>' + item.NamaPelanggan + '</td>' +
                                        '<td>' + item.Alamat + '</td>' +
                                        '<td>' + item.NomorTlp + '</td>' +
                                        '<td>' +
                                        '<button class="btn btn-warning btn-sm editPelanggan" data-bs-toggle="modal" data-bs-target="#modaleditPelanggan" data-id="' + item.ID_pelanggan + '"> Edit </button>' +

                                        '<button class="btn btn-danger btn-sm hapusPelanggan" data-id="' + item.ID_pelanggan + '"> Hapus </button> ' +                                        
                                    '</td>' +
                                    '</tr>';
                                    pelangganTable.append(row);
                                    no++;
                                });
                            } else {
                                Swal.fire({
                                    icon: "error",
                                    title: "Oops...",
                                    text: "Something went wrong!",
                                    footer: '<a href="#">Why do I have this issue?</a>'
                                    });
                            }
                        },
                        error: function(xhr, status, error) {
                            alert('Terjadi kesalahan: ' + error);
                        }
                    });
                }
                
                tampil();
                $("#simpanPelanggan").on("click", function (e) {
                        e.preventDefault();
                        var formData = {
                            NamaPelanggan: $('#modalTambahPelanggan #NamaPelanggan').val(),
                            Alamat: $('#modalTambahPelanggan #Alamat').val(),
                            NomorTlp: $('#modalTambahPelanggan #NomorTlp').val(),
                        };

                        $.ajax({
                            url: '<?= base_url('pelanggan/simpan') ?>',
                            type: 'POST',
                            data: formData,
                            dataType: 'json',
                            success: function (hasil) {
                                if (hasil.status === 'success') {
                                    $('#modalTambahPelanggan').modal('hide');
                                    $('#modalTambahPelanggan form')[0].reset();
                                    tampil();
                                } else {
                                    alert('Gagal menyimpan data: ' + JSON.stringify(hasil.errors));
                                }
                            },
                            error: function (xhr, status, error) {
                                alert('Terjadi kesalahan: ' + error);
                            }
                        });
                    });

                    $(document).on("click", ".editPelanggan", function () {
                        var id = $(this).data("id");
                        $.ajax({
                            url: "<?= base_url('pelanggan/edit') ?>",
                            type: "GET",
                            data: { id: id },
                            dataType: "json",
                            success: function (hasil) {
                                if (hasil) {
                                    $('#editPelangganId').val(hasil.ID_pelanggan);
                                    $('#modaleditPelanggan #NamaPelanggan').val(hasil.NamaPelanggan);
                                    $('#modaleditPelanggan #Alamat').val(hasil.Alamat);
                                    $('#modaleditPelanggan #NomorTlp').val(hasil.NomorTlp);
                                    $('#modaleditPelanggan').modal("show");
                                } else {
                                    alert("Data pelanggan tidak ditemukan");
                                }
                            },
                            error: function (xhr, status, error) {
                                alert("Terjadi kesalahan: " + error);
                            }
                        });
                    });

                    $('#updatePelanggan').on("click", function (e) {
                        e.preventDefault();
                        var formData = {
                            id: $('#editPelangganId').val(),
                            NamaPelanggan: $('#modaleditPelanggan #NamaPelanggan').val(),
                            Alamat: $('#modaleditPelanggan #Alamat').val(),
                            NomorTlp: $('#modaleditPelanggan #NomorTlp').val(),
                        };

                        $.ajax({
                            url: '<?= base_url('pelanggan/update') ?>',
                            type: 'POST',
                            data: formData,
                            dataType: 'json',
                            success: function (hasil) {
                        
                                if (hasil.status === 'success') {
                                    $('#modaleditPelanggan').modal("hide");
                                    tampil();
                                } else {
                                    alert('Gagal memperbarui data');
                                }
                            },
                            error: function (xhr, status, error) {
                                alert('Terjadi kesalahan: ' + error);
                            }
                        });
                    });

                    $(document).on("click", ".hapusPelanggan", function() {
                        var id = $(this).data("id");
                        if (confirm("Apakah anda yakin ingin menghapus data ini?")) {
                            $.ajax({
                                url: '<?= base_url('pelanggan/hapus') ?>/' + id,
                                type: 'DELETE',
                                dataType: 'json',
                                success: function(response) {
                                    if (response.status === 'success') {
                                        alert('Data berhasil dihapus.');
                                        tampil(); 
                                    } else {
                                        alert('Gagal menghapus data: ' + response.message);
                                    }
                                },
                                error: function(xhr, status, error) {
                                    alert('Terjadi kesalahan: ' + error);
                                }
                            });
                        }
                    }); 



                });

        </script>
</body>
</html>