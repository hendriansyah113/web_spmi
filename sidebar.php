<?php
$currentPage = basename($_SERVER['PHP_SELF']); // Ambil nama file dari URL
?>

<div class="sidebar">
    <h3>Sistem Informasi Audit Mutu Internal (SIAMI)</h3>
    <p>Universitas Muhammadiyah Palangkaraya</p>
    <ul class="nav flex-column">
        <li class="nav-item">
            <a class="nav-link <?= ($currentPage == 'index.php') ? 'active' : '' ?>" href="<?= BASE_URL ?>admin/">
                <i class="fas fa-home"></i>&nbsp; Dashboard
            </a>


            <ul class="dropdown-menu" aria-labelledby="userDropdown">
                <li><a class="dropdown-item" href="auditor/index.php">Auditor</a></li>
                <li><a class="dropdown-item" href="auditee/index.php">Auditee</a></li>
            </ul>
        </li>
        <div class="divider"></div>
        <!-- New Menu Item: Audit Mutu Internal -->
        <li class="nav-item">
            <a class="nav-link <?= ($currentPage == 'pelaksanaan.php' || $currentPage == 'penilaian.php' || $currentPage == 'hasil.php') ? 'active' : '' ?>"
                href="<?= BASE_URL ?>admin/manual/pelaksanaan.php">
                <i class="fas fa-chart-line"></i>&nbsp; Audit Mutu Internal
            </a>
        </li>
        <?php if ($_SESSION['role'] == 'admin'): ?>
        <div class="divider"></div>
        <li class="nav-item">
            <a class="nav-link nav-link <?= ($currentPage == 'standar.php' || $currentPage == 'sub_standar.php' || $currentPage == 'indikator.php' || $currentPage == 'nilai_indikator.php') ? 'active' : '' ?>"
                href="<?= BASE_URL ?>admin/manual/standar.php">
                <i class="fas fa-tasks"></i>&nbsp; Kelola Indikator
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link nav-link <?= ($currentPage == 'standar_audit.php' || $currentPage == 'uraian.php' || $currentPage == 'sub_uraian.php') ? 'active' : '' ?>"
                href="<?= BASE_URL ?>admin/manual/standar_audit.php">
                <i class="fas fa-check-circle"></i>&nbsp; Kelola Audit
            </a>
        </li>
        <div class="divider"></div>
        <li class="nav-item">
            <a class="nav-link nav-link <?= ($currentPage == 'user.php') ? 'active' : '' ?>"
                href="<?= BASE_URL ?>admin/user.php">
                <i class="fas fa-user"></i>&nbsp; Kelola User
            </a>
        </li>
        <?php endif; ?>
        <div class="divider"></div>
        <li class="nav-item">
            <a class="nav-link" href="<?= BASE_URL ?>proses_logout.php">
                <i class="fas fa-sign-out-alt"></i>&nbsp; Logout
            </a>
        </li>
    </ul>
</div>