<div class="container mt-3">
    <h1 class="fw-bold">Fine</h1>

    <div class="row">
        <div class="col-md-6">
            <h3>List of Fine</h3>
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
                    <th>Amount</th>
                    <th>Payment Status</th>
                    <th>Due Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data['fine'] as $fine) : ?>
                    <tr>
                        <td><?php echo $fine['FirstName']; ?></td>
                        <td><?php echo $fine['Amount']; ?></td>
                        <td><?php echo $fine['PaymentStatus']; ?></td>
                        <td><?php echo $fine['DueDate']; ?></td>
                        <form id="paid-form" action="<?= BASE_URL; ?>/staff/markPaid" method="post">
                            <input type="hidden" id="paid-form-patronId" name="patronId" value="<?php echo $fine['PatronId']; ?>">
                            <td>
                                <button class="btn btn-primary paid-button" data-id="<?php echo $fine['PatronId'] ?>"><i class="bi bi-check"></i> Mark as Paid</button>
                            </td>
                        </form>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="row">
        <div class="btn-primary text-center d-grid gap-2">
            <a href="<?= BASE_URL; ?>/staff/checkOverdueFine" class="btn btn-primary btn-add">Check & Assess Overdue Fine</a>
        </div>
        <div class="btn-primary text-center d-grid gap-2 mt-2">
            <a href="<?= BASE_URL; ?>/staff/sendFineNotif" class="btn btn-primary">Send Notification</a>
        </div>
    </div>
</div>

<script>
    document.querySelectorAll('.paid-button').forEach(item => {
        item.addEventListener('click', function(e) {
            e.preventDefault();

            const patronId = this.dataset.id;

            document.querySelector('#paid-form-patronId').value = patronId;
            document.querySelector('#paid-form').submit();
        })
    })
</script>