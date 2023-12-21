<div class="container mt-3">
    <h1 class="fw-bold">Bookshelf</h1>
    <div class="row">
        <div class="col-md-6">
            <h3>Available Books</h3>
        </div>
        <div class="col-md-6">
            <form action="<?= BASE_URL; ?>/patron/bookshelf" method="post">
                <div class="input-group mb-3">
                    <input id="search-input" type="text" name="keyword" class="form-control" placeholder="Search by Title" aria-label="Text input with dropdown button">
                    <input id="search-type" type="hidden" name="type" value="title">
                    <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Search by</button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="#" data-type="title">Title</a></li>
                        <li><a class="dropdown-item" href="#" data-type="isbn">ISBN</a></li>
                        <li><a class="dropdown-item" href="#" data-type="author">Author</a></li>
                    </ul>
                </div>
            </form>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-hover table-striped text-center">
            <thead>
                <tr>
                    <th>ISBN</th>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Genre</th>
                    <th>Publication Year</th>
                    <th>Quantity Available</th>
                    <th>Quantity Total</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data['books'] as $book) : ?>
                    <tr>
                        <td><?php echo $book['ISBN']; ?></td>
                        <td><?php echo $book['Title']; ?></td>
                        <td><?php echo $book['Author']; ?></td>
                        <td><?php echo $book['Genre']; ?></td>
                        <td><?php echo $book['PublicationYear']; ?></td>
                        <td><?php echo $book['QuantityAvailable']; ?></td>
                        <td><?php echo $book['QuantityTotal']; ?></td>
                        <td>
                            <a href="#" class="btn btn-primary btn-borrow" data-bs-toggle="modal" data-bs-target="#borrowModal" data-book="<?php echo htmlspecialchars(json_encode($book), ENT_QUOTES, 'UTF-8'); ?>">Borrow</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <script>
        document.querySelectorAll('.dropdown-item').forEach(item => {
            item.addEventListener('click', function(e) {
                e.preventDefault();
                document.getElementById('search-input').placeholder = 'Search by ' + this.innerText;
                document.getElementById('search-type').value = this.dataset.type;
            });
        });

        document.querySelectorAll('.btn-primary').forEach(item => {
            item.addEventListener('click', function(e) {
                e.preventDefault();
                const bookData = JSON.parse(this.dataset.book);
                const modalBody = document.querySelector('#borrowModal .modal-body');
                modalBody.innerHTML = `
                    <h5>Title: ${bookData.Title}</h5>
                    <p>Author: ${bookData.Author}</p>
                    <p>Genre: ${bookData.Genre}</p>
                    <p>Publication Year: ${bookData.PublicationYear}</p>
                    <p>Quantity Available: ${bookData.QuantityAvailable}</p>
                    <p>Quantity Total: ${bookData.QuantityTotal}</p>
                `;
                document.getElementById('borrow-isbn').value = bookData.ISBN;
            });
        });

        document.querySelectorAll('.btn-borrow').forEach(item => {
            if (item.parentNode.parentNode.children[5].innerText == 0) {
                item.classList.add('btn-danger');
                item.innerText = 'Reserve';
                item.setAttribute('data-bs-target', '#reserveModal');
            }
        });
    </script>

</div>


<!-- modal borrow -->
<div class="modal fade" id="borrowModal" tabindex="-1" aria-labelledby="borrowModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="borrowModalLabel">Confirm Borrow</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Book details will be dynamically inserted here -->
            </div>
            <form action="<?= BASE_URL; ?>/patron/loan&status=loan_success" method="post">
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <input id="borrow-isbn" type="hidden" name="isbn" value="">
                    <button type="submit" class="btn btn-primary">Borrow</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- modal reserve -->
<div class="modal fade" id="reserveModal" tabindex="-1" aria-labelledby="reserveModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="reserveModalLabel">Confirm Reserve</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h5>Book is not available. Do you want to reserve it?</h5>
            </div>
            <form action="<?= BASE_URL; ?>/patron/reservation" method="post">
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <input id="reserve-isbn" type="hidden" name="isbn" value="">
                    <button type="submit" class="btn btn-primary">Reserve</button>
                </div>
            </form>
        </div>
    </div>
</div>