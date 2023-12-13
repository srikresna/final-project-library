<div class="container">
    <h1>Loan</h1>

    <div class="row">
        <div class="col-md-6">
            <h2>Your Loan</h2>
        </div>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>ISBN</th>
                <th>Title</th>
                <th>Loan Date</th>
                <th>Due Date</th>
                <th>Return Date</th>
                <th>Actions</th>
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
                    <td>
                        <?php if ($loan['ReturnDate'] === null) : ?>
                            <button class="btn btn-primary">Mark as Returned</button>
                        <?php else : ?>
                            Loan Returned
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
</div>