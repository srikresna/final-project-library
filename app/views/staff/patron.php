<div class="container mt-3">
    <h1 class="fw-bold">Patron</h1>

    <div class="row">
        <div class="col-md-6">
            <h3>List of Patron</h3>
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

    <div class="table-responsive">
        <table class="table table-striped table-hover text-center">
            <thead>
                <tr>
                    <th>ID</th>
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
                        <td><?php echo $user['PatronId']; ?></td>
                        <td><?php echo $user['FirstName']; ?></td>
                        <td><?php echo $user['LastName']; ?></td>
                        <td><?php echo $user['Email']; ?></td>
                        <td><?php echo $user['PhoneNumber']; ?></td>
                        <td><?php echo $user['Address']; ?></td>
                        <td>
                            <button class="btn btn-primary edit-button" data-id="<?php echo htmlspecialchars(json_encode($user), ENT_QUOTES, 'UTF-8'); ?>" data-bs-toggle="modal" data-bs-target="#edit-modal"><i class="bi bi-pencil-fill"></i></button>
                            <button class="btn btn-danger delete-button" data-id="<?php echo $user['PatronId']; ?>" data-bs-toggle="modal" data-bs-target="#delete-modal"><i class="bi bi-trash-fill"></i></button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="row">
        <div class="btn-primary text-center d-grid gap-2">
            <a class="btn btn-primary btn-add" data-bs-toggle="modal" data-bs-target="#add-modal">Add Patron</a>
        </div>
    </div>
</div>

<!-- Modal Edit-->
<div class="modal fade" id="edit-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Patron</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="edit-form" action="<?= BASE_URL; ?>/staff/editPatron" method="post">
                    <input type="hidden" id="edit-form-id">
                    <div class="mb-3">
                        <label for="edit-form-patronId" class="form-label">ID</label>
                        <input type="text" class="form-control" id="edit-form-patronId" name="patronId" data-id="<?php echo $user['PatronId']; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="edit-form-firstname" class="form-label">Firstname</label>
                        <input type="text" class="form-control" id="edit-form-firstname" name="firstname" data-id="<?php echo $user['FirstName']; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="edit-form-lastname" class="form-label">Lastname</label>
                        <input type="text" class="form-control" id="edit-form-lastname" name="lastname" data-id="<?php echo $user['LastName']; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="edit-form-email" class="form-label">Email</label>
                        <input type="text" class="form-control" id="edit-form-email" name="email" data-id="<?php echo $user['Email']; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="edit-form-phonenumber" class="form-label">Phone Number</label>
                        <input type="text" class="form-control" id="edit-form-phonenumber" name="phonenumber" data-id="<?php echo $user['PhoneNumber']; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="edit-form-address" class="form-label">Address</label>
                        <input type="text" class="form-control" id="edit-form-address" name="address" data-id="<?php echo $user['Address']; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="edit-form-username" class="form-label">username</label>
                        <input type="text" class="form-control" id="edit-form-username" name="username" data-id="<?php echo $user['Username']; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="edit-form-password" class="form-label">password</label>
                        <input type="password" class="form-control" id="edit-form-password" name="password" data-id="<?php echo $user['Password']; ?>">
                        <div class="form-check mt-1">
                            <input class="form-check-input" type="checkbox" id="show-edit-password">
                            <label class="form-check-label" for="show-edit-password">Show password</label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mt-1">Save changes</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Add -->
<div class="modal fade" id="add-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Patron</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="add-form" action="<?= BASE_URL; ?>/staff/addPatron" method="post">
                    <div class="mb-3">
                        <label for="add-form-firstname" class="form-label">Firstname</label>
                        <input type="text" class="form-control" id="add-form-firstname" name="firstname">
                    </div>
                    <div class="mb-3">
                        <label for="add-form-lastname" class="form-label">Lastname</label>
                        <input type="text" class="form-control" id="add-form-lastname" name="lastname">
                    </div>
                    <div class="mb-3">
                        <label for="add-form-email" class="form-label">Email</label>
                        <input type="text" class="form-control" id="add-form-email" name="email">
                    </div>
                    <div class="mb-3">
                        <label for="add-form-phonenumber" class="form-label">Phone Number</label>
                        <input type="text" class="form-control" id="add-form-phonenumber" name="phonenumber">
                    </div>
                    <div class="mb-3">
                        <label for="add-form-address" class="form-label">Address</label>
                        <input type="text" class="form-control" id="add-form-address" name="address">
                    </div>
                    <div class="mb-3">
                        <label for="add-form-username" class="form-label">username</label>
                        <input type="text" class="form-control" id="add-form-username" name="username">
                    </div>
                    <div class="mb-3">
                        <label for="add-form-password" class="form-label">password</label>
                        <input type="password" class="form-control" id="add-form-password" name="password">
                        <div class="form-check mt-1">
                            <input class="form-check-input" type="checkbox" id="show-password">
                            <label class="form-check-label" for="show-password">Show password</label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mt-1">Add Patron</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- modal delete -->
<div class="modal fade" id="delete-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete Patron</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this patron?</p>
            </div>
            <form action="<?= BASE_URL; ?>/staff/deletePatron" method="post">
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                    <input id="delete-form-id" type="hidden" name="patronId" value="">
                    <input id="delete-form-bookId" type="hidden" name="isbn" value="">
                    <button type="submit" class="btn btn-danger" id="delete-confirm-button">Yes</button>
                </div>
            </form>
        </div>
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

    document.querySelectorAll('.delete-button').forEach(item => {
        item.addEventListener('click', function(e) {
            document.getElementById('delete-form-id').value = this.dataset.id;
        });
    });

    document.querySelectorAll('.edit-button').forEach(item => {
        item.addEventListener('click', function(e) {
            let data = JSON.parse(this.dataset.id);
            document.getElementById('edit-form-id').value = this.dataset.id;
            document.getElementById('edit-form-patronId').value = data.PatronId;
            document.getElementById('edit-form-firstname').value = data.FirstName;
            document.getElementById('edit-form-lastname').value = data.LastName;
            document.getElementById('edit-form-email').value = data.Email;
            document.getElementById('edit-form-phonenumber').value = data.PhoneNumber;
            document.getElementById('edit-form-address').value = data.Address;
            document.getElementById('edit-form-username').value = data.Username;
            document.getElementById('edit-form-password').value = data.Password;
        });
    });

    document.getElementById('show-password').addEventListener('change', function(e) {
        if (this.checked) {
            document.getElementById('add-form-password').type = 'text';
        } else {
            document.getElementById('add-form-password').type = 'password';
        }
    });

    document.getElementById('show-edit-password').addEventListener('change', function(e) {
        if (this.checked) {
            document.getElementById('edit-form-password').type = 'text';
        } else {
            document.getElementById('edit-form-password').type = 'password';
        }
    });
</script>