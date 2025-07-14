<?php
include 'header.php';
require_once '../includes/db.php';
$sql = "SELECT b.id, b.jml_bayar, b.status, t.bulan, p.nama AS nama_penghuni, k.nomor AS nomor_kamar
        FROM tb_bayar b
        JOIN tb_tagihan t ON b.id_tagihan = t.id
        JOIN tb_kmr_penghuni kp ON t.id_kmr_penghuni = kp.id
        JOIN tb_penghuni p ON kp.id_penghuni = p.id
        JOIN tb_kamar k ON kp.id_kamar = k.id
        ORDER BY b.id DESC";
$result = $conn->query($sql);
?>
<div class='d-flex justify-content-between align-items-center mb-3'>
    <h4>Data Pembayaran</h4>
    <a href='bayar_form.php' class='btn btn-success'>Tambah Pembayaran</a>
</div>
<table class='table table-bordered table-striped'>
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Penghuni</th>
            <th>Nomor Kamar</th>
            <th>Bulan</th>
            <th>Jumlah Bayar</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php $no=1; $adaData=false; while($row = $result->fetch_assoc()): $adaData=true; ?>
        <tr>
            <td><?= $no++ ?></td>
            <td><?= htmlspecialchars($row['nama_penghuni']) ?></td>
            <td><?= htmlspecialchars($row['nomor_kamar']) ?></td>
            <td><?= htmlspecialchars($row['bulan']) ?></td>
            <td>Rp <?= number_format($row['jml_bayar'], 0, ',', '.') ?></td>
            <td><?= htmlspecialchars(ucfirst($row['status'])) ?></td>
            <td>
                <a href="bayar_form.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                <a href="bayar_hapus.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus data?')">Hapus</a>
            </td>
        </tr>
        <?php endwhile; if(!$adaData): ?>
        <tr><td colspan="7" class="text-center text-muted">Belum ada data pembayaran.</td></tr>
        <?php endif; ?>
    </tbody>
</table>
<?php include 'footer.php'; ?> 