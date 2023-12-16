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
            <?php foreach ($data['loans'] as $loan) : ?>
                <tr>
                    <td><?php echo $loan['ISBN']; ?></td>
                    <td><?php echo $loan['Title']; ?></td>
                    <td><?php echo $loan['LoanDate']; ?></td>
                    <td><?php echo $loan['DueDate']; ?></td>
                    <td><?php echo $loan['ReturnDate']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
</div>