<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>kasir</title>

    <link rel="stylesheet" href="<?=base_url('assets/bootstrap-5.3.3-dist/css/bootstrap.min.css')?>">
    <link rel="stylesheet" href="<?=base_url('assets/fontawesome-free-6.6.0-web/css/all.min.css')?>">
</head>
<body>
    <div class="container"><br><br>
        <h3 class="text-center">Data Produk</h3> 
        <button type="button" class="btn btn-success float-end" data-bs-toggle="modal" data-bs-target="#modalTambahProduk"><i class="fa-solid fa-cart-plus me-1"></i>Tambah Produk</button><br><br>
        <div class="row">
            <div class="col-12">
                <div class="container mt-5">
                    <table class="table table-bordered" id="produkTable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Produk</th>
                                <th>Harga</th>
                                <th>Stok</th>
                                <th>Produk</th>
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
    <script src="<?=base_url('assets/bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js')?>"></script>
    <div class="modal fade" id="modalTambahProduk" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalTambahProduk" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel" style="color: blue;">Tambah Produk</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <form>
                <div class="row mb-3">
                    <label for="inputEmail3" class="col-sm-4 col-form-label">Nama Produk</label>
                    <div class="col-sm-8">
                    <input type="text" class="form-control" id="namaProduk">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputEmail3" class="col-sm-4 col-form-label">Harga</label>
                    <div class="col-sm-8">
                    <input type="number" class="form-control" id="hargaProduk">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputPassword3" class="col-sm-4 col-form-label">Stok</label>
                    <div class="col-sm-8">
                    <input type="number" class="form-control" id="stokProduk">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputGambar" class="col-sm-4 col-form-label">Gambar Produk</label>
                    <div class="col-sm-8">
                        <input type="file" class="form-control" id="gambarProduk"  >
                    </div>
                </div>

                <button type="submit" class="btn btn-primary float-end" id="simpanProduk">Simpan</button>
                
                </form>
            </div>
            
            </div>
        </div>
        </div> 
        <div class="modal fade" id="modaleditProduk" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modaleditProduk" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modaleditProduk" style="color: blue;">Edit Produk</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <form id="formeditproduk" >
            <input type="hidden" id="editProdukId">
                <div class="row mb-3">
                    <label for="editnamaProduk" class="col-sm-4 col-form-label">Nama Produk</label>
                    <div class="col-sm-8">
                    <input type="text" class="form-control" id="editnamaProduk">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="edithargaProduk" class="col-sm-4 col-form-label">Harga</label>
                    <div class="col-sm-8">
                    <input type="number" class="form-control" id="edithargaProduk">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="editstokProduk" class="col-sm-4 col-form-label">Stok</label>
                    <div class="col-sm-8">
                    <input type="text" class="form-control" id="editstokProduk" >
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="editgambarProduk" class="col-sm-4 col-form-label">Gambar</label>
                    <div class="col-sm-8">
                    <input type="file" class="form-control" id="editgambarProduk" >
                    </div>
                </div>
                <button type="submit" class="btn btn-primary float-end" id="updateProduk">Edit</button>
                
                </form>
            </div>
            
            </div>
        </div>
        </div>
        <script>
            $(document).ready(function(){
                function tampilProduk() {
                    $.ajax({
                        url: '<?=base_url('produk/tampil') ?>',
                        type: 'GET',
                        dataType: 'json',
                        success: function(hasil) {
                            
                            
                            if (hasil.status === 'success') {
                                var produkTable = $('#produkTable tbody');
                                produkTable.empty(); //hapus semua isi 

                                var produk = hasil.produk;
                                var no = 1;

                                // looping untuk memasukan data ke daalm tabel
                                produk.forEach(function(item){
                                    var row = '<tr>' +
                                        '<td>' + no + '</td>' +
                                        '<td>' + item.nama_produk + '</td>' +
                                        '<td>' + item.harga + '</td>' +
                                        '<td>' + item.stok + '</td>' +
                                        '<td>' + item.gambar_produk + '</td>' +
                                        '<td>' +
                                            '<button class="btn btn-warning btn-sm editProduk" data-bs-toggle="modal" data-bs-target="#modaleditProduk" data-id="' + item.produk_id + '"><i class="fa-solid fa-pencil"></i> Edit </button> ' +
                                            '<button class="btn btn-danger btn-sm hapusProduk" data-id="' + item.produk_id + '"><i class="fa-solid fa-trash-can"></i> Hapus </button> ' +
                                        '</td>' +
                                    '</tr>';
                                    produkTable.append(row);
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
                
                tampilProduk();
                    $("#simpanProduk").on("click", function(){
                        var formData = {
                            nama_produk: $('#namaProduk').val(),
                            harga: $('#hargaProduk').val(),
                            stok: $('#stokProduk').val(),
                            gambar_produk: $('#gambarProduk').val()
                        };
                        console.log(formData);
                        $.ajax({
                            url: '<?=base_url('produk/simpan');?>',
                            type: 'POST',
                            data: formData,
                            dataType: 'json',
                            success: function(hasil){
                                console.log(hasil);
                                if(hasil.status === 'success'){
                                    //alert(hasil.message);
                                    $('#modalTambahProduk').modal('hide');
                                    $('#formProduk')[0].reset();
                                    tampilProduk();
                                } else {
                                    alert('Gagal menyimpan data: ' + JSON.stringify(hasil.errors));
                                }
                            },
                            error: function(xhr, status, error) {
                                alert('Terjadi kesalahan: ' + error);
                            }
                        });

                    });
                

                // Saat tombol Edit Produk diklik, tampilkan modal dengan data produk
                $(document).on("click", ".editProduk", function(){
                    var id = $(this).data("id"); // Ambil ID dari tombol yang diklik
                    $.ajax({
                        url: '<?= base_url('produk/edit')?>',
                        type: 'GET',
                        data: { id: id }, // Kirim ID ke server
                        dataType: 'json',
                        success: function(hasil) {
                            if (hasil) {
                                // Isi input modal dengan data produk
                                $("#editProdukId").val(hasil.produk_id); 
                                $("#editnamaProduk").val(hasil.nama_produk);
                                $("#edithargaProduk").val(hasil.harga);
                                $("#editstokProduk").val(hasil.stok);
                                $("#editgamabrProduk").val(hasil.gambar_produk)
                                $("#modaleditProduk").modal("show");
                            } else {
                                alert('Gagal mengambil data untuk diedit.');
                            }
                        },
                        error: function(xhr, status, error) {
                            alert('Terjadi kesalahan: ' + error);
                        }
                    });
                });

                $("#updateProduk").on("click", function(e) {
                    e.preventDefault();

                    
                    var formData = {
                        id : $("#editProdukId").val(),
                        nama_produk: $("#editnamaProduk").val(),
                        harga: $("#edithargaProduk").val(),
                        stok: $("#editstokProduk").val(),
                        gambar_produk: $("#editgambarProduk").val()
                    };

                    $.ajax({
                        url: '<?= base_url('produk/update/') ?>', // URL dengan ID
                        type: 'POST',
                        data: formData,
                        dataType: 'json',
                        success: function(hasil) {
                            if (hasil.status === 'success') {
                                $("#modaleditProduk").modal("hide"); // Tutup modal
                                alert('Data berhasil diperbarui.');
                                tampilProduk();
                            } else {
                                alert('Gagal memperbarui data: ' + JSON.stringify(hasil.errors));
                            }
                        },
                        error: function(xhr, status, error) {
                            alert('Terjadi kesalahan: ' + error);
                        }
                    });
                });

                $(document).on("click", ".hapusProduk", function() {
                var id = $(this).data("id");
                if (confirm("Apakah anda yakin ingin menghapus data ini?")) {
                    $.ajax({
                        url: '<?= base_url('produk/hapus') ?>/' + id,
                        type: 'DELETE',
                        dataType: 'json',
                        success: function(response) {
                            if (response.status === 'success') {
                                alert('Data berhasil dihapus.');
                                tampilProduk(); // Refresh tabel produk
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
