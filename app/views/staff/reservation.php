<div class="container">
    <h1>Reservation</h1>

    <div class="row">
        <div class="col-md-6">
            <h2>List of Reservation</h2>
        </div>
        <div class="col-md-6">
            <form action="<?= BASE_URL; ?>/staff/reservation" method="post">
                <div class="input-group mb-3">
                    <input id="search-input" type="text" name="keyword" class="form-control" placeholder="Search by FirstName" aria-label="Text input with dropdown button">
                    <input id="search-type" type="hidden" name="type" value="firstname">
                    <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Search by</button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="#" data-type="firstname">FirstName</a></li>
                        <li><a class="dropdown-item" href="#" data-type="title">Title</a></li>
                        <li><a class="dropdown-item" href="#" data-type="isbn">ISBN</a></li>
                    </ul>
                </div>
            </form>
        </div>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>Patron</th>
                <th>ISBN</th>
                <th>Title</th>
                <th>Reservation Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data['reserve'] as $res) : ?>
                <tr>
                    <td><?php echo $res['FirstName']; ?></td>
                    <td><?php echo $res['ISBN']; ?></td>
                    <td><?php echo $res['Title']; ?></td>
                    <td><?php echo $res['ReservationDate']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="row">
        <div class="btn-primary text-center">
            <a href="<?= BASE_URL; ?>/staff/addBook" class="btn btn-primary">Add Reservation</a>
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