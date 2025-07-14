<?php
include 'header.php';
require_once '../includes/db.php';
$sql = "SELECT kp.id, p.nama AS nama_penghuni, k.nomor AS nomor_kamar, kp.tgl_masuk, kp.tgl_keluar
        FROM tb_kmr_penghuni kp
        JOIN tb_penghuni p ON kp.id_penghuni = p.id
        JOIN tb_kamar k ON kp.id_kamar = k.id
        ORDER BY kp.id DESC";
$result = $conn->query($sql);
?>
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4>Data Kamar Penghuni</h4>
    <a href="kmr_penghuni_form.php" class="btn btn-success">Tambah Data</a>
</div>
<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Penghuni</th>
            <th>Nomor Kamar</th>
            <th>Tgl Masuk</th>
            <th>Tgl Keluar</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php $no=1; $adaData=false; while($row = $result->fetch_assoc()): $adaData=true; ?>
        <tr>
            <td><?= $no++ ?></td>
            <td><?= htmlspecialchars($row['nama_penghuni']) ?></td>
            <td><?= htmlspecialchars($row['nomor_kamar']) ?></td>
            <td><?= htmlspecialchars($row['tgl_masuk']) ?></td>
            <td><?= htmlspecialchars($row['tgl_keluar']) ?></td>
            <td>
                <a href="kmr_penghuni_form.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                <a href="kmr_penghuni_hapus.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus data?')">Hapus</a>
            </td>
        </tr>
        <?php endwhile; if(!$adaData): ?>
        <tr><td colspan="6" class="text-center text-muted">Belum ada data kamar penghuni.</td></tr>
        <?php endif; ?>
    </tbody>
</table>
<?php include 'footer.php'; ?> 