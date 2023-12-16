<div class="container mt-3">
    <h1 class="fw-bold">Reservation</h1>

    <div class="row">
        <div class="col-md-6">
            <h3>List of Reservation</h3>
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

    <div class="table-responsive">
        <table class="table table-striped table-hover text-center">
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
    </div>
    <div class="row">
        <div class="btn-primary text-center d-grid gap-2">
            <a class="btn btn-primary btn-add" data-bs-toggle="modal" data-bs-target="#add-modal">Add Reservation</a>
        </div>
        <div class="btn-primary text-center d-grid gap-2 mt-2">
            <a href="<?= BASE_URL; ?>/staff/sendReserveNotif" class="btn btn-primary">Send Notification</a>
        </div>
    </div>
</div>

<!-- Modal Edit -->
<div class="modal fade" id="edit-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Reservation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="add-form" action="<?= BASE_URL; ?>/staff/editReserve" method="post">
                    <input id="edit-form-id" type="hidden" name="patronId" value="">
                    <div class="mb-3">
                        <label for="edit-form-firstname" class="form-label">FirstName</label>
                        <input type="text" class="form-control" id="edit-form-firstname" name="firstname" data-id="<?php echo $user['FirstName']; ?>" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="edit-form-isbn" class="form-label">ISBN</label>
                        <input type="text" class="form-control" id="edit-form-isbn" name="isbn" data-id="<?php echo $user['ISBN']; ?>" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="edit-form-title" class="form-label">Title</label>
                        <input type="text" class="form-control" id="edit-form-title" name="username" data-id="<?php echo $user['Title']; ?>" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="edit-form-date" class="form-label">Reservation Date</label>
                        <input type="date" class="form-control" id="edit-form-date" name="date" data-id="<?php echo $user['ReservationDate']; ?>">
                    </div>
                    <button type="submit" class="btn btn-primary">Add Reserve</button>
                </form>
            </div>
        </div>
    </div>
</div>

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
                        <select class="form-select" id="add-form-patron" name="patron">
                            <?php foreach ($data['firstname'] as $patron) : ?>
                                <option value="<?php echo $patron['PatronId']; ?>"><?php echo $patron['FirstName']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="add-form-isbn" class="form-label">ISBN</label>
                        <select class="form-select" id="add-form-isbn" name="isbn">
                            <?php foreach ($data['isbn'] as $book) : ?>
                                <option value="<?php echo $book['BookId']; ?>"><?php echo $book['ISBN'] . ' - ' . $book['Title'];; ?></option>
                            <?php endforeach; ?>
                        </select>
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
                    <input id="delete-form-bookId" type="hidden" name="isbn" value="">
                    <input id="delete-form-reserveDate" type="hidden" name="reserveDate" value="">
                    <button class="btn btn-danger delete-button" data-id='<?php echo json_encode(array("PatronId" => $res['PatronId'], "ISBN" => $res['ISBN'], "ReservationDate" => $res['ReservationDate'])); ?>' data-bs-toggle="modal" data-bs-target="#delete-modal">Yes</button>
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
            let data = JSON.parse(this.dataset.id);
            document.getElementById('delete-form-id').value = data.PatronId;
            document.getElementById('delete-form-bookId').value = data.ISBN;
            document.getElementById('delete-form-reserveDate').value = data.ReservationDate;
        });
    });

    document.querySelectorAll('.edit-button').forEach(item => {
        item.addEventListener('click', function(e) {
            let data = JSON.parse(this.dataset.id);
            document.getElementById('edit-form-id').value = data.PatronId;
            document.getElementById('edit-form-firstname').value = data.FirstName;
            document.getElementById('edit-form-isbn').value = data.ISBN;
            document.getElementById('edit-form-title').value = data.Title;
            document.getElementById('edit-form-date').value = data.ReservationDate;
        });
    });

    const reservationDateEdit = document.querySelector('#edit-form-date');
    const reservationDateAdd = document.querySelector('#add-form-date');
    const today = new Date().toISOString().split('T')[0];
    reservationDateEdit.setAttribute('min', today);
    reservationDateAdd.setAttribute('min', today);
</script>