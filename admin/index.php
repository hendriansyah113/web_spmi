<?php
include '../config.php';

$role = $_SESSION['role']; // ID pengguna yang login

// Query notifikasi untuk pengguna tertentu
$query = "SELECT id, message, form_link, is_read, created_at FROM notifications WHERE role = '$role' AND is_read = 0 ORDER BY created_at DESC";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SPMI Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <style>
    body {
        font-family: 'Roboto', sans-serif;
        background-color: #f8f9fa;
    }

    .sidebar {
        background-color: #343a40;
        color: white;
        min-height: 100vh;
        padding: 15px;
        width: 300px;
        position: fixed;
    }

    .sidebar h3 {
        color: #007bff;
    }

    .sidebar .nav-link {
        color: #dcdcdc;
        display: flex;
        align-items: center;
        padding: 10px;
        border-radius: 5px;
    }

    .sidebar .nav-link.active {
        color: white;
        background-color: #007bff;
    }

    .sidebar .nav-link:hover {
        color: white;
        background-color: #007bff;
    }

    .sidebar .submenu {
        margin-left: 20px;
        font-size: 0.9em;
    }

    .divider {
        border-bottom: 1px solid #495057;
        margin: 15px 0;
    }

    .content {
        padding: 20px;
        margin-left: 320px;
        background-color: #ffffff;
        width: calc(100% - 320px);
    }

    .dashboard-header h2 {
        font-size: 2rem;
        font-weight: bold;
        color: #343a40;
    }

    .menu-container {
        display: flex;
        justify-content: space-around;
        margin: 20px 0;
    }

    .menu-item {
        flex: 1;
        padding: 20px;
        color: #fff;
        text-align: center;
        margin: 0 10px;
        border-radius: 5px;
    }

    .menu-item a {
        display: block;
        margin-top: 10px;
        color: #fff;
        text-decoration: none;
        font-weight: bold;
    }
    </style>
</head>

<body>
    <div class="d-flex">

        <?php
        include '../sidebar.php'; ?>

        <div class="content">
            <div class="dashboard-header">
                <h2>Beranda Aplikasi <?= $_SESSION['role'] ?> (Dashboard)</h2>
            </div>

            <div class="menu-container">
                <div class="menu-item" style="background-color: #4CAF50;">
                    <p>Fakultas</p>
                    <a href="manual/indexadmin.php">Lihat</a>
                </div>
                <div class="menu-item" style="background-color: #F44336;">
                    <p>Program Studi</p>
                    <a href="manual/index.php">Baca</a>
                </div>
                <div class="menu-item" style="background-color: #2196F3;">
                    <p>Auditor</p>
                    <a href="#">Baca</a>
                </div>
                <div class="menu-item" style="background-color: #FFC107;">
                    <p>Gugus Kendali Mutu</p>
                    <a href="manual/gkm.php">Lihat</a>
                </div>
            </div>
            <!-- Notifikasi -->
            <div class="notifications mt-4">
                <h4>Notifikasi</h4>
                <ul class="list-group">
                    <?php while ($row = $result->fetch_assoc()): ?>
                    <li class="list-group-item <?= $row['is_read'] === '0' ? 'list-group-item-warning' : ''; ?>"
                        onclick="markAsRead(<?= $row['id']; ?>, '<?= $row['form_link']; ?>')">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <p class="mb-1"><?= $row['message']; ?></p>
                                <small class="text-muted"><?= $row['created_at']; ?></small>
                            </div>
                            <i class="fa <?= $row['is_read'] === '0' ? 'fa-envelope' : 'fa-envelope-open'; ?>"></i>
                        </div>
                    </li>
                    <?php endwhile; ?>
                </ul>
            </div>
        </div>


        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
        <script>
        function markAsRead(notificationId, link) {
            // Kirim permintaan ke server untuk memperbarui status is_read
            fetch('notifikasi.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    id: notificationId
                })
            }).then(response => {
                if (response.ok) {
                    // Redirect ke link setelah berhasil
                    window.location.href = link;
                } else {
                    alert('Gagal memperbarui status notifikasi.');
                }
            });
        }
        </script>
</body>

</html>