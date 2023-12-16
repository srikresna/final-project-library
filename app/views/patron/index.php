<div class="container">
    <br><br><br>
    <h2 class="fw-bold">Welcome, <?php echo $_SESSION['username'] ?>!<span class="wave-hand">👋</span></h2>
    <br><br><br><br>
    <div class="row decorative-menu">
        <div class="col-md-12 mb-3">
            <h3>What do you want?</h3>
        </div>
        <div class="col-md-3">
            <div class="box">
                <h4>Bookshelf</h4>
                <p class="lead">Search and borrow the book</p>
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
                <h4>Information</h4>
                <p>Show the latest information</p>
                <a href="<?= BASE_URL; ?>/patron/information" class="btn btn-primary">Go to Information</a>
            </div>
        </div>
    </div>
</div>

<style>
    body {
        background-color: #e7e5e4;
    }

    .box {
        transition: transform .2s;
        /* Animation */
        animation: fade-in 1s ease-out;
    }

    @keyframes fade-in {
        0% {
            opacity: 0;
        }

        100% {
            opacity: 1;
        }
    }

    .box h4 {
        transition: color .2s;
    }

    .box:hover h4 {
        color: #007bff;
    }

    .box:hover {
        transform: scale(1.05);
        /* (150% zoom - Note: if the zoom is too large, it will go outside of the viewport) */
    }

    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
        color: #fff;
        transition: background-color .2s, border-color .2s;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        border-color: #0056b3;
    }

    .wave-hand {
        animation-name: wave-animation;
        /* Refer to the name of your @keyframes element below */
        animation-duration: 2.5s;
        /* Change to speed up or slow down */
        animation-iteration-count: infinite;
        /* Never stop waving :) */
        transform-origin: 70% 70%;
        /* Pivot around the bottom-left palm */
        display: inline-block;
    }

    @keyframes wave-animation {
        0% {
            transform: rotate(0.0deg)
        }

        10% {
            transform: rotate(14.0deg)
        }

        /* The following five values can be played with to make the waving more or less extreme */
        20% {
            transform: rotate(-8.0deg)
        }

        30% {
            transform: rotate(14.0deg)
        }

        40% {
            transform: rotate(-4.0deg)
        }

        50% {
            transform: rotate(10.0deg)
        }

        60% {
            transform: rotate(0.0deg)
        }

        /* Reset for the last half to pause */
        100% {
            transform: rotate(0.0deg)
        }
    }

    .decorative-menu {
        border: 2px solid #007bff;
        padding: 2rem;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
    }
</style>