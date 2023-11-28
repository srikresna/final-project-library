<div class="container">
    <br><br><br><br><br>
    <h2>Welcome, <?php echo $_SESSION['username']?>!</h2>
    <br><br><br><br><br><br><br><br>
    <div class="row">
        <div class="col-md-3">
            <div class="box">
                <h4>Bookshelf</h4>
                <p>Search and borrow the book</p>
                <a href="<?= BASE_URL; ?>/patron/bookshelf" class="btn btn-primary">Go to Bookshelf</a>
            </div>
        </div>
        <div class="col-md-3">
            <div class="box">
                <h4>Loan</h4>
                <p>Check your loaned books</p>
                <a href="<?= BASE_URL; ?>/patron/loan" class="btn btn-primary">Go to Loan</a>
            </div>
        </div>
        <div class="col-md-3">
            <div class="box">
                <h4>Reservation</h4>
                <p>Check your book reservations</p>
                <a href="<?= BASE_URL; ?>/patron/reservation" class="btn btn-primary">Go to Reservation</a>
            </div>
        </div>
        <div class="col-md-3">
            <div class="box">
                <h4>Return</h4>
                <p>Return your loaned books</p>
                <a href="<?= BASE_URL; ?>/patron/return" class="btn btn-primary">Go to Return</a>
            </div>
        </div>
    </div>
</div>