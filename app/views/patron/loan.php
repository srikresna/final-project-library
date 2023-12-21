<div class="container mt-3">
    <h1 class="fw-bold">Loan</h1>

    <div class="row">
        <div class="col-md-6">
            <h3>Your Loan</h3>
        </div>
    </div>
    <?php
    if (isset($_GET['status']) && $_GET['status'] == 'loan_success') {

        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Success!</strong> Your request is being process, please come to the library to take your book.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
    }
    ?>
    <table class="table table-striped table-hover text-center">
        <thead>
            <tr>
                <th>ISBN</th>
                <th>Title</th>
                <th>Loan Date</th>
                <th>Due Date</th>
                <th>Return Date</th>

            </tr>
        </thead>
        <tbody>
            <?php
            if (count($data['loans']) == 0) {
                echo '<tr><td colspan="5">No loan found.</td></tr>';
            } else {
                foreach ($data['loans'] as $loan) {
                    echo '<tr>';
                    echo '<td>' . $loan['ISBN'] . '</td>';
                    echo '<td>' . $loan['Title'] . '</td>';
                    echo '<td>' . $loan['LoanDate'] . '</td>';
                    echo '<td>' . $loan['DueDate'] . '</td>';
                    echo '<td>' . $loan['ReturnDate'] . '</td>';
                    echo '</tr>';
                }
            }
            ?>
        </tbody>
    </table>
</div>
</div>