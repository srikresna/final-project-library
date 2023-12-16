<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= BASE_URL; ?>/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <title><?= $data['title']; ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
    </style>
</head>

<div class="container">
    <hr>
    <h3 class="text-center">Library Report</h3>
    <hr style="border:3px solid;">
    <br><br>
    <h5>Table Information for Patron</h5>
    <hr>
    <table class="table table-striped text-center">
        <thead>
            <tr>
                <th>Patron</th>
                <th>Phone</th>
                <th>Total Return</th>
                <th>Total Unreturn</th>
                <th>Total Overdue</th>
                <th>Total Fine</th>
                <th>Unpaid Fine</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data['reportUser'] as $report) : ?>
                <tr>
                    <td><?php echo $report['FirstName']; ?></td>
                    <td><?php echo $report['PhoneNumber']; ?></td>
                    <td><?php echo $report['TotalReturned']; ?></td>
                    <td><?php echo $report['TotalNotReturned']; ?></td>
                    <td><?php echo $report['TotalOverdue']; ?></td>
                    <td><?php echo $report['TotalFine']; ?></td>
                    <td><?php echo $report['UnpaidFine']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <br>
    <h5>Table Information for Book</h5>
    <hr>
    <table class="table table-striped text-center">
        <thead>
            <tr>
                <th>Title</th>
                <th>ISBN</th>
                <th>Total Loans</th>
                <th>Total Unreturn</th>
                <th>Total Overdue</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data['reportBook'] as $book) : ?>
                <tr>
                    <td><?php echo $book['Title']; ?></td>
                    <td><?php echo $book['ISBN']; ?></td>
                    <td><?php echo $book['TotalLoaned']; ?></td>
                    <td><?php echo $book['TotalNotReturned']; ?></td>
                    <td><?php echo $book['TotalOverdue']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <br>
    <div class="row">
        <p class="text-end">Signature, <?php echo date('d-m-Y'); ?></p>
        <br><br><br>
        <p class="text-end">Librarian Staff</p>
    </div>
</div>

<script>
    window.print();
</script>