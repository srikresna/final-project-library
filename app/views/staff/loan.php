<div class="container">
    <h1>Loan</h1>

    <div class="row">
        <div class="col-md-6">
            <h2>List of Loans</h2>
        </div>
        <div class="col-md-6">
            <form action="<?= BASE_URL; ?>/staff/loan" method="post">
                <div class="input-group mb-3">
                    <input id="search-input" type="text" name="keyword" class="form-control" placeholder="Search by Title" aria-label="Text input with dropdown button">
                    <input id="search-type" type="hidden" name="type" value="title">
                    <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Search by</button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item type-search" href="#" data-type="title">Title</a></li>
                        <li><a class="dropdown-item type-search" href="#" data-type="isbn">ISBN</a></li>
                        <li><a class="dropdown-item type-search" href="#" data-type="patron">Patron</a></li>
                    </ul>
                </div>
            </form>
        </div>
    </div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ISBN</th>
                <th>Title</th>
                <th>Patron</th>
                <th>Loan Date</th>
                <th>Due Date</th>
                <th>Return Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data['loans'] as $loan) : ?>
                <tr>
                    <td><?php echo $loan['ISBN']; ?></td>
                    <td><?php echo $loan['Title']; ?></td>
                    <td><?php echo $loan['FirstName']; ?></td>
                    <td><?php echo $loan['LoanDate']; ?></td>
                    <td><?php echo $loan['DueDate']; ?></td>
                    <td><?php echo $loan['ReturnDate']; ?></td>
                    <td>
                        <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-three-dots-vertical"></i>
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <li>
                                    <a class="dropdown-item btn-assess-fine" href="#" data-id="<?php echo $loan['PatronId']; ?>" data-date="<?php echo date('Y-m-d', strtotime($loan['DueDate'] . ' + 3 days')); ?>">
                                        Assess Fine
                                    </a>
                                </li>
                                <li>
                                    <?php if ($loan['ReturnDate'] == null) : ?>
                                        <a class="dropdown-item btn-mark-return" href="#" data-book-id="<?php echo $loan['BookId']; ?>" data-patron-id="<?php echo $loan['PatronId']; ?>">
                                            Mark as Return
                                        </a>
                                    <?php else : ?>
                                        <a class="dropdown-item" href="#">
                                            Already Returned
                                        </a>
                                    <?php endif; ?>
                                </li>
                                <li>
                                    <a class="dropdown-item text-danger btn-delete" href="#" data-book-id="<?php echo $loan['BookId']; ?>" data-patron-id="<?php echo $loan['PatronId']; ?>">
                                        Delete
                                    </a>
                                </li>
                            </ul>
                            <form id="delete-form" action="<?= BASE_URL; ?>/staff/deleteLoan" method="post">
                                <input type="hidden" id="delete-book-id" name="bookId">
                                <input type="hidden" id="delete-patron-id" name="patronId">
                            </form>
                            <form id="return-form" action="<?= BASE_URL; ?>/staff/markReturn" method="post">
                                <input type="hidden" id="return-book-id" name="bookId">
                                <input type="hidden" id="return-patron-id" name="patronId">
                                <input type="hidden" id="return-date" name="returnDate">
                            </form>
                            <form id="assess-fine-form" action="<?= BASE_URL; ?>/staff/assessFine" method="post">
                                <input type="hidden" id="assess-fine-patron-id" name="patronId">
                                <input type="hidden" id="assess-fine-amount" name="amount">
                                <input type="hidden" id="assess-fine-due" name="due">
                            </form>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="row">
        <div class="btn-primary text-center d-grid gap-2">
            <a href="<?= BASE_URL; ?>/staff/addLoan" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add-modal">Add Loan</a>
        </div>
        <div class="btn-primary text-center d-grid gap-2 mt-2">
            <a href="<?= BASE_URL; ?>/staff/sendLoanNotif" class="btn btn-primary">Send Notification</a>
        </div>
    </div>
</div>
<!-- Modal Add -->
<div class="modal fade" id="add-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Loan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="add-form" action="<?= BASE_URL; ?>/staff/addLoan" method="post">
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
                            <?php foreach ($data['available'] as $book) : ?>
                                <option value="<?php echo $book['BookId']; ?>">
                                    <?php echo $book['ISBN'] . ' - ' . $book['Title']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Add Loan</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    document.querySelectorAll('.type-search').forEach(item => {
        item.addEventListener('click', function(e) {
            e.preventDefault();
            document.getElementById('search-input').placeholder = 'Search by ' + this.innerText;
            document.getElementById('search-type').value = this.dataset.type;
        });
    });

    document.querySelectorAll('.btn-delete').forEach(item => {
        item.addEventListener('click', function(e) {
            e.preventDefault();

            const bookId = this.dataset.bookId;
            const patronId = this.dataset.patronId;

            document.getElementById('delete-book-id').value = bookId;
            document.getElementById('delete-patron-id').value = patronId;

            document.getElementById('delete-form').submit();
        });
    });

    document.querySelectorAll('.btn-mark-return').forEach(item => {
        item.addEventListener('click', function(e) {
            e.preventDefault();

            const bookId = this.dataset.bookId;
            const patronId = this.dataset.patronId;
            const today = new Date();
            const dd = String(today.getDate()).padStart(2, '0');
            const mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
            const yyyy = today.getFullYear();

            const returnDate = yyyy + '-' + mm + '-' + dd;

            document.getElementById('return-book-id').value = bookId;
            document.getElementById('return-patron-id').value = patronId;
            document.getElementById('return-date').value = returnDate;

            // Change button text to "Already Returned"
            this.innerText = "Already Returned";
            this.classList.remove("btn-mark-return");
            this.classList.add("disabled");

            document.getElementById('return-form').submit();
        });
    });

    document.querySelectorAll('.btn-assess-fine').forEach(item => {
        item.addEventListener('click', function(e) {
            e.preventDefault();

            const patronId = this.dataset.id;
            const dueDate = this.dataset.date;

            document.getElementById('assess-fine-patron-id').value = patronId;
            document.getElementById('assess-fine-amount').value = 10000;
            document.getElementById('assess-fine-due').value = dueDate;

            document.getElementById('assess-fine-form').submit();
        });
    });
</script>