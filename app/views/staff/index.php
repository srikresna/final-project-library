<div class="container">
    <br><br><br><br><br>
    <h2>Welcome, <?php echo $_SESSION['username'] ?>!</h2>
    <br><br><br><br><br><br><br><br>
    <div class="row">
        <div class="col-md-2">
            <div class="box">
                <h4>Bookshelf</h4>
                <p>Manage book or add book</p>
                <a href="<?= BASE_URL; ?>/staff/bookshelf" class="btn btn-primary">Go to Bookshelf</a>
            </div>
        </div>
        <div class="col-md-2">
            <div class="box">
                <h4>Patron</h4>
                <p>Manage every user on system</p>
                <a href="<?= BASE_URL; ?>/staff/patron" class="btn btn-primary">Go to Patron</a>
            </div>
        </div>
        <div class="col-md-2">
            <div class="box">
                <h4>Loan</h4>
                <p>Manage loaned book or asses fine</p>
                <a href="<?= BASE_URL; ?>/staff/loan" class="btn btn-primary">Go to Loan</a>
            </div>
        </div>
        <div class="col-md-2">
            <div class="box">
                <h4>Reservation</h4>
                <p>View reservation book</p>
                <a href="<?= BASE_URL; ?>/staff/reservation" class="btn btn-primary">Go to Reservation</a>
            </div>
        </div>
        <div class="col-md-2">
            <div class="box">
                <h4>Report</h4>
                <p>Show system report</p>
                <a href="<?= BASE_URL; ?>/staff/report" class="btn btn-primary">Go to Report</a>
            </div>
        </div>
    </div>
</div>