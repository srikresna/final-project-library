<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= BASE_URL; ?>/css/bootstrap.min.css">
    <title><?= $data['title']; ?></title>
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary" data-bs-theme="dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Library</a>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="<?=BASE_URL; ?>/home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?=BASE_URL; ?>/login">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?=BASE_URL; ?>/team">Team</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</body>

</html>