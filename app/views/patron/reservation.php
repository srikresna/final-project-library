<div class="container">
    <div class="d-flex mt-5">
        <div class="ms-auto">
            <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#currentLoans" aria-expanded="false" aria-controls="currentLoans">
                Toggle Current Loans
            </button>
            <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#reservationHistory" aria-expanded="false" aria-controls="reservationHistory">
                Toggle Current Reservation
            </button>
        </div>
    </div>

    <div class="card mt-3 collapse" id="currentLoans">
        <div class="card-header">
            <h1>Current Loans</h1>
        </div>
        <div class="card-body">
            <table class="table text-center table-hover">
                <thead>
                    <tr>
                        <th>Book Title</th>
                        <th>Due Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data['loaned'] as $loaned) : ?>
                        <tr>
                            <td><?php echo $loaned['Title']; ?></td>
                            <td><?php echo $loaned['DueDate']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="card mt-3 collapse" id="reservationHistory">
        <div class="card-header">
            <h1>Current Reservation</h1>
        </div>
        <div class="card-body">
            <table class="table text-center table-hover">
                <thead>
                    <tr>
                        <th>Book Title</th>
                        <th>Reservation Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data['active_reserve'] as $active) : ?>
                        <tr>
                            <td><?php echo $active['Title']; ?></td>
                            <td><?php echo $active['ReservationDate']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>


    <div class="mt-3">
        <h1 class="fw-bold">Reservation History</h1>
    </div>

    <?php
    if (isset($_GET['status']) && $_GET['status'] == "date_taken") {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Failed!</strong> The date you choose is already taken, please choose another date.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
    } else if (isset($_GET['status']) && $_GET['status'] == "reserve_success") {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Success!</strong> Your reservation is added. Come again to the library at the date you choose to take your book.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
    } else if (isset($_GET['status']) && $_GET['status'] == "failed") {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Failed!</strong> Something went wrong, please try again.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
    }
    ?>
    <table class="table table-hover text-center table-striped">
        <thead>
            <tr>
                <th>Book Title</th>
                <th>Reservation Date</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (count($data['reserve']) == 0) {
                echo '<tr><td colspan="2">No reservations found.</td></tr>';
            } else {
                foreach ($data['reserve'] as $reserve) {
                    echo '<tr>';
                    echo '<td>' . $reserve['Title'] . '</td>';
                    echo '<td>' . $reserve['ReservationDate'] . '</td>';
                    echo '</tr>';
                }
            }
            ?>
        </tbody>
    </table>
    <div class="text-center">
        <button class="btn btn-primary" id="create-reservation" data-bs-toggle="modal" data-bs-target="#reserveForm">Create Reservation</button>
    </div>
</div>


<div class="modal fade" id="reserveForm" tabindex="-1" aria-labelledby="reserveFormLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="reserveFormLabel">New Reservation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?= BASE_URL; ?>/patron/reservation" method="post">
                    <div class="mb-3">
                        <label for="isbn" class="form-label">ISBN</label>
                        <select class="form-select" id="add-form-isbn" name="isbn">
                            <?php foreach ($data['books'] as $book) : ?>
                                <option value="<?php echo $book['ISBN']; ?>">
                                    <?php echo $book['ISBN'] . ' - ' . $book['Title']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="reservationDate" class="form-label">Reservation Date</label>
                        <input type="date" class="form-control" id="reservationDate" name="reservationDate" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="submit_res">Save Reservation</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    const submitRes = document.querySelector('#submit_res');
    const isbn = document.querySelector('#isbn');
    const reservationDate = document.querySelector('#reservationDate');

    isbn.addEventListener('input', () => {
        const regex13 = /^[0-9]{13}$/;
        if (regex13.test(isbn.value)) {
            isbn.classList.add('is-valid');
            isbn.classList.remove('is-invalid');
            new bootstrap.Popover(isbn);

        } else {
            isbn.classList.add('is-invalid');
            isbn.classList.remove('is-valid');
            new bootstrap.Popover(isbn);
        }
    });

    const today = new Date().toISOString().split('T')[0];
    reservationDate.setAttribute('min', today);
</script>