<?php
include 'header.php';
require_once '../includes/db.php';
$result = $conn->query("SELECT * FROM tb_kamar ORDER BY id DESC");
?>
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4>Data Kamar</h4>
    <a href="kamar_form.php" class="btn btn-success">Tambah Kamar</a>
</div>
<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>No</th>
            <th>Nomor Kamar</th>
            <th>Harga Sewa</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php $no=1; $adaData=false; while($row = $result->fetch_assoc()): $adaData=true; ?>
        <tr>
            <td><?= $no++ ?></td>
            <td><?= htmlspecialchars($row['nomor']) ?></td>
            <td>Rp <?= number_format($row['harga'], 0, ',', '.') ?></td>
            <td>
                <a href="kamar_form.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                <a href="kamar_hapus.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus data?')">Hapus</a>
            </td>
        </tr>
        <?php endwhile; if(!$adaData): ?>
        <tr><td colspan="4" class="text-center text-muted">Belum ada data kamar.</td></tr>
        <?php endif; ?>
    </tbody>
</table>
<?php include 'footer.php'; ?> 