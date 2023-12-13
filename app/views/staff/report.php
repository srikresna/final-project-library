<div class="container">
    <h1>Report</h1>

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

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Patron</th>
                <th>Phone</th>
                <th>Total Returned</th>
                <th>Total Unreturned</th>
                <th>Total Overdue</th>
                <th>Total Fine</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data['report'] as $report) : ?>
                <tr>
                    <td><?php echo $report['FirstName']; ?></td>
                    <td><?php echo $report['PhoneNumber']; ?></td>
                    <td><?php echo $report['TotalReturned']; ?></td>
                    <td><?php echo $report['TotalNotReturned']; ?></td>
                    <td><?php echo $report['TotalOverdue']; ?></td>
                    <td><?php echo $report['TotalFine']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

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