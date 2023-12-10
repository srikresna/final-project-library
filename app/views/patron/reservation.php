<div class="container">
    <div class="d-flex justify-content-between mt-5">
        <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#currentLoans" aria-expanded="false" aria-controls="currentLoans">
            Toggle Current Loans
        </button>
        <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#reservationHistory" aria-expanded="false" aria-controls="reservationHistory">
            Toggle Current Reservation
        </button>
    </div>

    <div class="card mt-3 collapse" id="currentLoans">
        <div class="card-header">
            <h1>Current Loans</h1>
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>Book Title</th>
                        <th>Borrower</th>
                        <th>Due Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data['loaned'] as $loaned) : ?>
                        <tr>
                            <td><?php echo $loaned['Title']; ?></td>
                            <td><?php echo $loaned['FirstName']; ?></td>
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
            <table class="table">
                <thead>
                    <tr>
                        <th>Book Title</th>
                        <th>Reservator</th>
                        <th>Reservation Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data['active_reserve'] as $active) : ?>
                        <tr>
                            <td><?php echo $active['Title']; ?></td>
                            <td><?php echo $active['FirstName']; ?></td>
                            <td><?php echo $active['ReservationDate']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <h1>Reservation History</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Book Title</th>
                <th>Reservation Date</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data['reserve'] as $userReserve) : ?>
                <tr>
                    <td><?php echo $userReserve['Title']; ?></td>
                    <td><?php echo $userReserve['ReservationDate']; ?></td>
                </tr>
            <?php endforeach; ?>
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
                        <input type="text" class="form-control" id="isbn" name="isbn" required>
                    </div>
                    <div class="mb-3">
                        <label for="reservationDate" class="form-label">Reservation Date</label>
                        <input type="date" class="form-control" id="reservationDate" name="reservationDate" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Reservation</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>