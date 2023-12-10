<div class="container">
    <h1>Loan</h1>

    <div class="row">
        <div class="col-md-6">
            <h2>Your Loan</h2>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <div class="input-group">
                    <input type="text" class="form-control" id="search" placeholder="Search">
                    <div class="input-group-append">
                        <button type="button" class="btn btn-primary" id="searchBtn">Search</button>
                    </div>
                </div>
            </div>
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