<div class="table-responsive">
    <table class="table table-bordered">
        <tr>
            <td colspan="7" class="text-center">
                <a href="multiple_insert_penduduk/form.php" class="btn btn-success">Tambah Dokumen</a>
                <a href="pdf" class="btn btn-primary">Cetak PDF</a>
                <a href="import" class="btn btn-primary">Import</a>
                <a href="export_dokumen/index_export.php" class="btn btn-primary">Export</a>
            </td>
        </tr>
        <tr>
            <th>NO</th>
            <th>HARI/TANGGAL</th>
            <th>FAKULTAS</th>
            <th>PROGRAM STUDI</th>
            <th>JADWAL</th>
            <th>KETERANGAN</th>
        </tr>
        <?php
        include "koneksi.php";

        $page = (isset($_POST['page'])) ? $_POST['page'] : 1;
        $limit = 5; 
        $no = (($page - 1) * $limit) + 1;
        $limit_start = ($page - 1) * $limit;

        if (isset($_POST['search']) && $_POST['search'] == true) {
            $param = '%' . $keyword . '%';
            $sql = $pdo->prepare("SELECT * FROM jadwal_ami WHERE judul LIKE :judul OR deskripsi LIKE :deskripsi LIMIT " . $limit_start . "," . $limit);
            $sql->bindParam(':judul', $param);
            $sql->bindParam(':deskripsi', $param);
            $sql->execute();
            $sql2 = $pdo->prepare("SELECT COUNT(*) AS jumlah FROM jadwal_ami WHERE judul LIKE :judul OR deskripsi LIKE :deskripsi ");
            $sql2->bindParam(':judul', $param);
            $sql2->bindParam(':deskripsi', $param);
            $sql2->execute();
            $get_jumlah = $sql2->fetch();
        } else {
            $sql = $pdo->prepare("SELECT * FROM jadwal_ami LIMIT " . $limit_start . "," . $limit);
            $sql->execute();
            $sql2 = $pdo->prepare("SELECT COUNT(*) AS jumlah FROM jadwal_ami");
            $sql2->execute();
            $get_jumlah = $sql2->fetch();
        }

        while ($data = $sql->fetch()) {
            // Pastikan path lengkap termasuk direktori uploads
            $file_path = "dokumen_manual/uploads/" . $data['file_path'];
            ?>
            <tr>
                <td class="align-middle text-center"><?php echo $no; ?></td>
                <td class="align-middle"><?php echo $data['judul']; ?></td>
                <td class="align-middle"><?php echo $data['deskripsi']; ?></td>
                <td class="align-middle"><?php echo $data['tanggal_dibuat']; ?></td>
                <td class="align-middle">
                    <a href="<?php echo $file_path; ?>" class="btn btn-info" target="_blank">Lihat Dokumen</a>
                </td>
                <td class="align-middle">
                    <a href='form_ubah.php?id=<?php echo $data['id']; ?>' class='btn btn-warning'>Unduh</a>
                    
                </td>
            </tr>
            <?php
            $no++;
        }
        ?>
    </table>
</div>

<?php
if ($sql->rowCount() > 0) {
    ?>
    <ul class="pagination">
        <?php
        if ($page == 1) {
            ?>
            <li class="disabled"><a href="#">First</a></li>
            <li class="disabled"><a href="#">&laquo;</a></li>
        <?php
        } else {
            $link_prev = ($page > 1) ? $page - 1 : 1;
            ?>
            <li><a href="javascript:void(0);" onclick="searchWithPagination(1, 0)">First</a></li>
            <li><a href="javascript:void(0);" onclick="searchWithPagination(<?php echo $link_prev; ?>, 0)">&laquo;</a></li>
        <?php
        }

        $jumlah_page = ceil($get_jumlah['jumlah'] / $limit);
        $jumlah_number = 3;
        $start_number = ($page > $jumlah_number) ? $page - $jumlah_number : 1;
        $end_number = ($page < ($jumlah_page - $jumlah_number)) ? $page + $jumlah_number : $jumlah_page;

        for ($i = $start_number; $i <= $end_number; $i++) {
            $link_active = ($page == $i) ? ' class="active"' : '';
            ?>
            <li<?php echo $link_active; ?>><a href="javascript:void(0);" onclick="searchWithPagination(<?php echo $i; ?>, 0)"><?php echo $i; ?></a></li>
        <?php
        }

        if ($page == $jumlah_page) {
            ?>
            <li class="disabled"><a href="#">&raquo;</a></li>
            <li class="disabled"><a href="#">Last</a></li>
        <?php
        } else {
            $link_next = ($page < $jumlah_page) ? $page + 1 : $jumlah_page;
            ?>
            <li><a href="javascript:void(0);" onclick="searchWithPagination(<?php echo $link_next; ?>, 0)">&raquo;</a></li>
            <li><a href="javascript:void(0);" onclick="searchWithPagination(<?php echo $jumlah_page; ?>, 0)">Last</a></li>
        <?php
        }
        ?>
    </ul>
<?php
}
?>
