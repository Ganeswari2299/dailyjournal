<?php
//query untuk mengambil data article
$sql1 = "SELECT * FROM article ORDER BY tanggal DESC";
$hasil1 = $conn->query($sql1);

//query untuk mengambil data gallery
$sql1 = "SELECT * FROM gallery ORDER BY tanggal DESC";
$hasil1 = $conn->query($sql1);

//menghitung jumlah baris data article
$jumlah_article = $hasil1->num_rows; 

//menghitung jumlah baris data gallery
$jumlah_gallery = $hasil1->num_rows; 

// Ambil data foto user dari database berdasarkan session
$username = $_SESSION['username'];
$sql_user = "SELECT foto FROM user WHERE username = '$username'";
$result_user = $conn->query($sql_user);
$row_user = $result_user->fetch_assoc();
$foto_user = (!empty($row_user['foto'])) ? $row_user['foto'] : 'default.png';
?>

<div class="container text-center pt-4">
    <div class="mb-5">
        <p class="lead mb-0">Selamat Datang,</p>
        <h3 class="fw-bold text-danger mb-3"><?= $_SESSION['username'] ?></h3>
        <img src="img/<?= $foto_user ?>" class="rounded-circle shadow-sm border border-secondary-subtle" width="150" height="150" style="object-fit: cover;">
    </div>

<div class="row row-cols-1 row-cols-md-4 g-4 justify-content-center pt-4">
    <div class="col">
        <div class="card border border-danger mb-3 shadow" style="max-width: 18rem;">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div class="p-3">
                        <h5 class="card-title"><i class="bi bi-newspaper"></i> Article</h5> 
                    </div>
                    <div class="p-3">
                        <span class="badge rounded-pill text-bg-danger fs-2"><?php echo $jumlah_article; ?></span>
                    </div> 
                </div>
            </div>
        </div>
    </div> 
    <div class="col">
        <div class="card border border-danger mb-3 shadow" style="max-width: 18rem;">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div class="p-3">
                        <h5 class="card-title"><i class="bi bi-camera"></i> Gallery</h5> 
                    </div>
                    <div class="p-3">
                        <span class="badge rounded-pill text-bg-danger fs-2"><?php echo $jumlah_gallery; ?></span>
                    </div> 
                </div>
            </div>
        </div>
    </div> 
</div>