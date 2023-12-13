<div class="container">
    <h1>Loan</h1>

    <div class="row">
        <div class="col-md-6">
            <h2>List of Loans</h2>
        </div>
        <div class="col-md-6">
            <form action="<?= BASE_URL; ?>/staff/loan" method="post">
                <div class="input-group mb-3">
                    <input id="search-input" type="text" name="keyword" class="form-control" placeholder="Search by Title" aria-label="Text input with dropdown button">
                    <input id="search-type" type="hidden" name="type" value="title">
                    <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Search by</button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="#" data-type="title">Title</a></li>
                        <li><a class="dropdown-item" href="#" data-type="isbn">ISBN</a></li>
                        <li><a class="dropdown-item" href="#" data-type="patron">Patron</a></li>
                    </ul>
                </div>
            </form>
        </div>
    </div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ISBN</th>
                <th>Title</th>
                <th>Patron</th>
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
                    <td><?php echo $loan['FirstName']; ?></td>
                    <td><?php echo $loan['LoanDate']; ?></td>
                    <td><?php echo $loan['DueDate']; ?></td>
                    <td><?php echo $loan['ReturnDate']; ?></td>
                    <td>
                        <button class="btn btn-primary"><i class="bi bi-pencil-fill"></i></button>
                        <button class="btn btn-danger"><i class="bi bi-trash-fill"></i></button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="row">
        <div class="btn-primary text-center d-grid gap-2">
            <a href="<?= BASE_URL; ?>/staff/addBook" class="btn btn-primary">Add Loan</a>
        </div>
    </div>

    <script>
        document.querySelectorAll('.dropdown-item').forEach(item => {
            item.addEventListener('click', function(e) {
                e.preventDefault();
                document.getElementById('search-input').placeholder = 'Search by ' + this.innerText;
                document.getElementById('search-type').value = this.dataset.type;
            });
        });
    </script>
</div>