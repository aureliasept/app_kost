<?php
include 'header.php';
require_once '../includes/db.php';
$sql = "SELECT t.id, t.bulan, t.jml_tagihan, p.nama AS nama_penghuni, k.nomor AS nomor_kamar
        FROM tb_tagihan t
        JOIN tb_kmr_penghuni kp ON t.id_kmr_penghuni = kp.id
        JOIN tb_penghuni p ON kp.id_penghuni = p.id
        JOIN tb_kamar k ON kp.id_kamar = k.id
        ORDER BY t.id DESC";
$result = $conn->query($sql);
?>
<div class='d-flex justify-content-between align-items-center mb-3'>
    <h4>Data Tagihan</h4>
    <a href='tagihan_form.php' class='btn btn-success'>Tambah Tagihan</a>
</div>
<table class='table table-bordered table-striped'>
    <thead>
        <tr>
            <th>No</th>
            <th>Bulan</th>
            <th>Nama Penghuni</th>
            <th>Nomor Kamar</th>
            <th>Jumlah Tagihan</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php $no=1; $adaData=false; while($row = $result->fetch_assoc()): $adaData=true; ?>
        <tr>
            <td><?= $no++ ?></td>
            <td><?= htmlspecialchars($row['bulan']) ?></td>
            <td><?= htmlspecialchars($row['nama_penghuni']) ?></td>
            <td><?= htmlspecialchars($row['nomor_kamar']) ?></td>
            <td>Rp <?= number_format($row['jml_tagihan'], 0, ',', '.') ?></td>
            <td>
                <a href="tagihan_form.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                <a href="tagihan_hapus.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus data?')">Hapus</a>
            </td>
        </tr>
        <?php endwhile; if(!$adaData): ?>
        <tr><td colspan="6" class="text-center text-muted">Belum ada data tagihan.</td></tr>
        <?php endif; ?>
    </tbody>
</table>
<?php include 'footer.php'; ?> 