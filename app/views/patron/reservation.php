<div class="container">
    <h1>Reservation</h1>

    <div class="row">
        <div class="col-md-6">
            <h2>Your Reservation</h2>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <div class="input-group">
                    <input type="text" class="form-control" id="search" placeholder="Search">
                    <div class="input-group-append">
                        <button type="button" class="btn btn-primary" id="searchBtn">Search</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>Book Title</th>
                <th>Reservation Date</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($data['book'] as $book) : ?>
            <tr>
                <td><?php echo $book['Title']; ?></td>
                <?php foreach ($data['date'] as $date) : ?>
                    <td><?php echo $date['ReservationDate']; ?></td>
                <?php endforeach; ?>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>