<div class="container mt-3">
    <h1 class="fw-bold">Report</h1>

    <div class="row">
        <div class="col-md-6">
        </div>
        <div class="col-md-6">
            <form action="<?= BASE_URL; ?>/staff/report" method="post">
                <div class="input-group mb-3">
                    <input id="search-input" type="text" name="keyword" class="form-control" placeholder="Search by Name" aria-label="Text input with dropdown button">
                    <input id="search-type" type="hidden" name="type" value="name">
                    <div class="btn btn-primary" type="submit">Search</div>
                </div>
            </form>
        </div>
    </div>

    <h5>Table Information for Patron</h5>
    <hr>
    <div class="table-responsive">
        <table class="table table-striped table-hover text-center">
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
    </div>
    <br>
    <h5>Table Information for Book</h5>
    <hr>
    <div class="table-responsive">
        <table class="table table-striped table-hover text-center">
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
    </div>
    <br>
    <div class="row">
        <div class="btn-primary text-center d-grid gap-2">
            <a href="<?= BASE_URL; ?>/staff/printReport" class="btn btn-primary">Print Report</a>
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