<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'header.php';
require_once '../includes/db.php';
$result = $conn->query("
    SELECT p.*, k.nomor AS nomor_kamar
    FROM tb_penghuni p
    LEFT JOIN (
        SELECT kp1.*
        FROM tb_kmr_penghuni kp1
        INNER JOIN (
            SELECT id_penghuni, MAX(tgl_masuk) AS max_masuk
            FROM tb_kmr_penghuni
            GROUP BY id_penghuni
        ) kp2 ON kp1.id_penghuni = kp2.id_penghuni AND kp1.tgl_masuk = kp2.max_masuk
    ) kp ON kp.id_penghuni = p.id
    LEFT JOIN tb_kamar k ON kp.id_kamar = k.id
    ORDER BY p.id DESC
");
function getBarangBawaan($conn, $id_penghuni) {
    $q = $conn->query("SELECT b.nama FROM tb_brng_bawaan bb JOIN tb_barang b ON bb.id_barang = b.id WHERE bb.id_penghuni = $id_penghuni");
    $arr = [];
    while($r = $q->fetch_assoc()) $arr[] = $r['nama'];
    return implode(', ', $arr);
}
?>
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4>Data Penghuni</h4>
    <a href="penghuni_form.php" class="btn btn-success">Tambah Penghuni</a>
</div>
<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>No KTP</th>
            <th>No HP</th>
            <th>Nomor Kamar</th>
            <th>Barang Bawaan</th>
            <th>Tgl Masuk</th>
            <th>Tgl Keluar</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php $no=1; while($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= $no++ ?></td>
            <td><?= htmlspecialchars($row['nama']) ?></td>
            <td><?= htmlspecialchars($row['no_ktp']) ?></td>
            <td><?= htmlspecialchars($row['no_hp']) ?></td>
            <td><?= htmlspecialchars($row['nomor_kamar'] ?? '-') ?></td>
            <td><?= htmlspecialchars(getBarangBawaan($conn, $row['id'])) ?></td>
            <td><?= htmlspecialchars($row['tgl_masuk']) ?></td>
            <td><?= htmlspecialchars($row['tgl_keluar']) ?></td>
            <td>
                <a href="penghuni_form.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                <a href="penghuni_hapus.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus data?')">Hapus</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>
<?php include 'footer.php'; ?> 