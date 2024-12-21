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
        include '../config.php';
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

            <!-- Bootstrap Bundle with Popper -->
            <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>

</html>