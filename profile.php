<?php
// Ambil data user yang sedang login dari session
$username = $_SESSION['username'];

// 1. QUERY UNTUK MENAMPILKAN DATA (SELECT)
$sql = "SELECT * FROM user WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$hasil = $stmt->get_result();
$data = $hasil->fetch_assoc();

// 2. PROSES UPDATE DATA JIKA TOMBOL SIMPAN DIKLIK
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $password = $_POST['password'];
    $foto_baru = $_FILES['foto']['name'];

    // Jika user mengganti password
    if (!empty($password)) {
        $password_md5 = md5($password);
        $sql_pass = "UPDATE user SET password = ? WHERE username = ?";
        $stmt_pass = $conn->prepare($sql_pass);
        $stmt_pass->bind_param("ss", $password_md5, $username);
        $stmt_pass->execute();
    }

    // Jika user mengupload foto baru
    if (!empty($foto_baru)) {
        $target_dir = "img/"; // Pastikan kamu punya folder 'img'
        $target_file = $target_dir . basename($foto_baru);
        
        // Pindahkan file dari komputer user ke folder img proyek kita
        if (move_uploaded_file($_FILES['foto']['tmp_name'], $target_file)) {
            $sql_foto = "UPDATE user SET foto = ? WHERE username = ?";
            $stmt_foto = $conn->prepare($sql_foto);
            $stmt_foto->bind_param("ss", $foto_baru, $username);
            $stmt_foto->execute();
        }
    }

    // Refresh halaman agar data terbaru langsung muncul
    echo "<script>alert('Profil berhasil diperbarui!'); window.location='admin.php?page=profile';</script>";
}
?>

<div class="container mt-3">
    <form action="" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label class="form-label">Username</label>
            <input type="text" class="form-control" name="username" value="<?= htmlspecialchars($data['username']) ?>" readonly>
        </div>
        <div class="mb-3">
            <label class="form-label">Ganti Password</label>
            <input type="password" class="form-control" name="password" placeholder="Tuliskan Password Baru Jika Ingin Mengganti Password Saja">
        </div>
        <div class="mb-3">
            <label class="form-label">Ganti Foto Profil</label>
            <input type="file" class="form-control" name="foto">
        </div>
        <div class="mb-3">
            <label class="form-label d-block">Foto Profil Saat Ini</label>
            <?php
            
            // Cek apakah ada foto di database, jika tidak ada pakai gambar default
            $foto_tampil = !empty($data['foto']) ? $data['foto'] : 'default_profile.png';
            ?>
            <img src="img/<?= $foto_tampil ?>" width="150" class="img-thumbnail rounded shadow-sm">
        </div>
        <button type="submit" class="btn btn-primary">simpan</button>
    </form>
</div>