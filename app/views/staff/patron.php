<div class="container">
    <h1>Patron</h1>

    <div class="row">
        <div class="col-md-6">
            <h2>List of Patron</h2>
        </div>
        <div class="col-md-6">
            <form action="<?= BASE_URL; ?>/staff/patron" method="post">
                <div class="input-group mb-3">
                    <input id="search-input" type="text" name="keyword" class="form-control" placeholder="Search by FirstName" aria-label="Text input with dropdown button">
                    <input id="search-type" type="hidden" name="type" value="firstname">
                    <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Search by</button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="#" data-type="firstname">FirstName</a></li>
                        <li><a class="dropdown-item" href="#" data-type="phone">PhoneNumber</a></li>
                        <li><a class="dropdown-item" href="#" data-type="address">Address</a></li>
                    </ul>
                </div>
            </form>
        </div>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Phone Number</th>
                <th>Address</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data['patron'] as $user) : ?>
                <tr>
                    <td><?php echo $user['FirstName']; ?></td>
                    <td><?php echo $user['LastName']; ?></td>
                    <td><?php echo $user['Email']; ?></td>
                    <td><?php echo $user['PhoneNumber']; ?></td>
                    <td><?php echo $user['Address']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="row">
        <div class="btn-primary text-center">
            <a href="<?= BASE_URL; ?>/staff/addBook" class="btn btn-primary">Add Patron</a>
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