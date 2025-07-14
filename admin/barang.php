<?php
include 'header.php';
require_once '../includes/db.php';
$result = $conn->query("SELECT * FROM tb_barang ORDER BY id DESC");
?>
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4>Data Barang</h4>
    <a href="barang_form.php" class="btn btn-success">Tambah Barang</a>
</div>
<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Barang</th>
            <th>Harga</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php $no=1; $adaData=false; while($row = $result->fetch_assoc()): $adaData=true; ?>
        <tr>
            <td><?= $no++ ?></td>
            <td><?= htmlspecialchars($row['nama']) ?></td>
            <td>Rp <?= number_format($row['harga'], 0, ',', '.') ?></td>
            <td>
                <a href="barang_form.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                <a href="barang_hapus.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus data?')">Hapus</a>
            </td>
        </tr>
        <?php endwhile; if(!$adaData): ?>
        <tr><td colspan="4" class="text-center text-muted">Belum ada data barang.</td></tr>
        <?php endif; ?>
    </tbody>
</table>
<?php include 'footer.php'; ?> 