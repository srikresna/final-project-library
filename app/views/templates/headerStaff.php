<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= BASE_URL; ?>/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <script src="<?= BASE_URL; ?>/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap">
    <link rel="icon" href="<?= BASE_URL; ?>/img/favicon.png">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        .navbar-nav.right {
            margin-left: auto;
        }
    </style>

    <title><?= $data['title']; ?> | Library</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary sticky-md-top" data-bs-theme="dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="<?= BASE_URL; ?>/staff/index">Halmahera Library</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <ul class="navbar-nav right">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= BASE_URL; ?>/staff/index">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= BASE_URL; ?>/staff/bookshelf">Bookshelf</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= BASE_URL; ?>/staff/patron">Patron</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= BASE_URL; ?>/staff/loan">Loan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= BASE_URL; ?>/staff/reservation">Reservation</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= BASE_URL; ?>/staff/fine">Fine</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= BASE_URL; ?>/staff/report">Report</a>
                    </li>
                    <li class="nav-item">
                        <!-- logout -->
                        <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#logoutModal">Log Out</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>


</body>

<div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-body-tertiary">
            <div class="modal-header">
                <h5 class="modal-title" id="logoutModalLabel">Log Out Confirmation</h5>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to log out?</p>
            </div>
            <div class="modal-footer">
                <a href="<?= BASE_URL; ?>/staff/logout" class="btn btn-danger">Yes</a>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
            </div>
        </div>

    </div>
</div>

</html>