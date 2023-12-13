<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= BASE_URL; ?>/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <script src="<?= BASE_URL; ?>/js/bootstrap.bundle.min.js"></script>
    <title><?= $data['title']; ?></title>
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary sticky-md-top" data-bs-theme="dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="<?= BASE_URL; ?>/staff/index">Library</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <ul class="navbar-nav">
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
                        <a class="nav-link" href="<?= BASE_URL; ?>/staff/report">Report</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= BASE_URL; ?>/staff/logout">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</body>

</html>