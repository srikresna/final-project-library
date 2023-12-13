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

    <table class="table table-striped">
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
                    <td>
                        <button class="btn btn-primary edit-button" data-id="<?php echo htmlspecialchars(json_encode($res), ENT_QUOTES, 'UTF-8'); ?>" data-bs-toggle="modal" data-bs-target="#edit-modal"><i class="bi bi-pencil-fill"></i></button>
                        <button class="btn btn-danger delete-button" data-id="<?php echo $res['PatronId']; ?>" data-bs-toggle="modal" data-bs-target="#delete-modal"><i class="bi bi-trash-fill"></i></button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="row">
        <div class="btn-primary text-center d-grid gap-2">
            <a class="btn btn-primary btn-add" data-bs-toggle="modal" data-bs-target="#add-modal">Add Reservation</a>
        </div>
    </div>
</div>

<div class="modal fade" id="edit-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Reservation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="edit-form" action="<?= BASE_URL; ?>/staff/editReserve" method="post">
                    <input type="hidden" id="edit-form-id">
                    <div class="mb-3">
                        <label for="edit-form-isbn" class="form-label">ISBN</label>
                        <input type="text" class="form-control" id="edit-form-isbn" name="isbn" data-id="<?php echo $user['ISBN']; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="edit-form-title" class="form-label">Title</label>
                        <input type="text" class="form-control" id="edit-form-title" name="title" data-id="<?php echo $user['Title']; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="edit-form-date" class="form-label">Reservation Date</label>
                        <input type="date" class="form-control" id="edit-form-date" name="date" data-id="<?php echo $user['ReservationDate']; ?>">
                    </div>
                    <button type="submit" class="btn btn-primary">Save changes</button>
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
                <h5 class="modal-title">Add Reservation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="add-form" action="<?= BASE_URL; ?>/staff/addReserve" method="post">
                    <div class="mb-3">
                        <label for="add-form-patron" class="form-label">Patron</label>
                        <input type="text" class="form-control" id="add-form-patron" name="firstname">
                    </div>
                    <div class="mb-3">
                        <label for="add-form-isbn" class="form-label">ISBN</label>
                        <input type="text" class="form-control" id="add-form-isbn" name="isbn">
                    </div>
                    <div class="mb-3">
                        <label for="add-form-title" class="form-label">Title</label>
                        <input type="text" class="form-control" id="add-form-title" name="title">
                    </div>
                    <div class="mb-3">
                        <label for="add-form-date" class="form-label">Reservation Date</label>
                        <input type="date" class="form-control" id="add-form-date" name="date">
                    </div>
                    <button type="submit" class="btn btn-primary">Add Reserve</button>
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
                <h5 class="modal-title">Delete Reservation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this reservation?</p>
            </div>
            <form action="<?= BASE_URL; ?>/staff/deleteReserve" method="post">
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                    <input id="delete-form-id" type="hidden" name="patronId" value="">
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
            document.getElementById('edit-form-id').value = data.PatronId;
            document.getElementById('edit-form-isbn').value = data.ISBN;
            document.getElementById('edit-form-title').value = data.Title;
            document.getElementById('edit-form-date').value = data.ReservationDate;
        });
    });
</script>