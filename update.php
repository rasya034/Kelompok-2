<?php
require_once 'database.php';

$id   = $_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM donasi WHERE id = $id"));

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama     = $_POST['nama_donatur'];
    $email    = $_POST['email'];
    $jumlah   = $_POST['jumlah'];
    $pesan    = $_POST['pesan'];
    $penerima = $_POST['penerima'];
    $status   = $_POST['status'];

    $query = "UPDATE donasi SET
                nama_donatur = '$nama',
                email        = '$email',
                jumlah       = '$jumlah',
                pesan        = '$pesan',
                penerima     = '$penerima',
                status       = '$status'
              WHERE id = $id";

    mysqli_query($conn, $query);
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Donasi</title>
</head>
<body>

<h2>Edit Donasi</h2>
<a href="index.php">← Kembali</a>
<br><br>

<form method="POST" action="">
    Nama Donatur : <input type="text" name="nama_donatur" value="<?= $data['nama_donatur'] ?>"><br><br>
    Email        : <input type="email" name="email" value="<?= $data['email'] ?>"><br><br>
    Penerima     : <input type="text" name="penerima" value="<?= $data['penerima'] ?>"><br><br>
    Jumlah (Rp)  : <input type="number" name="jumlah" value="<?= $data['jumlah'] ?>"><br><br>
    Pesan        : <textarea name="pesan"><?= $data['pesan'] ?></textarea><br><br>
    Status       :
    <select name="status">
        <option value="pending" <?= $data['status'] == 'pending' ? 'selected' : '' ?>>Pending</option>
        <option value="sukses"  <?= $data['status'] == 'sukses'  ? 'selected' : '' ?>>Sukses</option>
        <option value="gagal"   <?= $data['status'] == 'gagal'   ? 'selected' : '' ?>>Gagal</option>
    </select><br><br>
    <input type="submit" value="Update">
</form>

</body>
</html>