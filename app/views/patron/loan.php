<div class="container mt-3">
    <h1 class="fw-bold">Loan</h1>

    <div class="row">
        <div class="col-md-6">
            <h3>Your Loan</h3>
        </div>
    </div>

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