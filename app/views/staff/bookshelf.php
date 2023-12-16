<div class="container mt-3">
    <h1 class="fw-bold">Bookshelf</h1>

    <div class="row">
        <div class="col-md-6">
            <h3>List of Books</h3>
        </div>
        <div class="col-md-6">
            <form action="<?= BASE_URL; ?>/staff/bookshelf" method="post">
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
        <table class="table table-striped table-hover text-center">
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
                            <button class="btn btn-primary edit-button" data-id="<?php echo htmlspecialchars(json_encode($book), ENT_QUOTES, 'UTF-8'); ?>" data-bs-toggle="modal" data-bs-target="#edit-modal"><i class="bi bi-pencil-fill"></i></button>
                            <button class="btn btn-danger delete-button" data-id="<?php echo $book['ISBN']; ?>" data-bs-toggle="modal" data-bs-target="#delete-modal"><i class="bi bi-trash-fill"></i></button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="row">
        <div class="btn-primary text-center d-grid gap-2">
            <a class="btn btn-primary btn-add" data-bs-toggle="modal" data-bs-target="#add-modal">Add Book</a>
        </div>
    </div>
</div>
<!-- modal edit -->
<div class="modal fade" id="edit-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Book</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="edit-form" action="<?= BASE_URL; ?>/staff/editBook" method="post">
                    <input type="hidden" id="edit-form-id">
                    <div class="mb-3">
                        <label for="edit-form-isbn" class="form-label">ISBN</label>
                        <input type="text" class="form-control" id="edit-form-isbn" name="isbn" data-id="<?php echo $book['ISBN']; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="edit-form-title" class="form-label">Title</label>
                        <input type="text" class="form-control" id="edit-form-title" name="title" data-title="<?php echo $book['Title']; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="edit-form-author" class="form-label">Author</label>
                        <input type="text" class="form-control" id="edit-form-author" name="author" data-author="<?php echo $book['Author']; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="edit-form-genre" class="form-label">Genre</label>
                        <input type="text" class="form-control" id="edit-form-genre" name="genre" data-genre="<?php echo $book['Genre']; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="edit-form-publication-year" class="form-label">Publication Year</label>
                        <input type="date" class="form-control" id="edit-form-publication-year" name="publication_year" data-publication-year="<?php echo $book['PublicationYear']; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="edit-form-quantity-available" class="form-label">Quantity Available</label>
                        <input type="text" class="form-control" id="edit-form-quantity-available" name="quantity_available" data-quantity-available="<?php echo $book['QuantityAvailable']; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="edit-form-quantity-total" class="form-label">Quantity Total</label>
                        <input type="text" class="form-control" id="edit-form-quantity-total" name="quantity_total" data-quantity-total="<?php echo $book['QuantityTotal']; ?>">
                    </div>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- modal add -->
<div class="modal fade" id="add-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Book</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="edit-form" action="<?= BASE_URL; ?>/staff/addBook" method="post">
                    <input type="hidden" id="edit-form-id">
                    <div class="mb-3">
                        <label for="edit-form-isbn" class="form-label">ISBN</label>
                        <input type="text" class="form-control" id="edit-form-isbn" name="isbn">
                    </div>
                    <div class="mb-3">
                        <label for="edit-form-title" class="form-label">Title</label>
                        <input type="text" class="form-control" id="edit-form-title" name="title">
                    </div>
                    <div class="mb-3">
                        <label for="edit-form-author" class="form-label">Author</label>
                        <input type="text" class="form-control" id="edit-form-author" name="author">
                    </div>
                    <div class="mb-3">
                        <label for="edit-form-genre" class="form-label">Genre</label>
                        <input type="text" class="form-control" id="edit-form-genre" name="genre">
                    </div>
                    <div class="mb-3">
                        <label for="edit-form-publication-year" class="form-label">Publication Year</label>
                        <input type="date" class="form-control" id="edit-form-publication-year" name="publication_year">
                    </div>
                    <div class="mb-3">
                        <label for="edit-form-quantity-available" class="form-label">Quantity Available</label>
                        <input type="text" class="form-control" id="edit-form-quantity-available" name="quantity_available">
                    </div>
                    <div class="mb-3">
                        <label for="edit-form-quantity-total" class="form-label">Quantity Total</label>
                        <input type="text" class="form-control" id="edit-form-quantity-total" name="quantity_total">
                    </div>
                    <button type="submit" class="btn btn-primary">Save changes</button>
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
                <h5 class="modal-title">Delete Book</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this book?</p>
            </div>
            <form action="<?= BASE_URL; ?>/staff/deleteBook" method="post">
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                    <input id="delete-form-id" type="hidden" name="isbn" value="">
                    <button type="submit" class="btn btn-danger" id="delete-confirm-button">Yes</button>
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

    document.querySelectorAll('.delete-button').forEach(button => {
        button.addEventListener('click', function(e) {
            document.getElementById('delete-form-id').value = this.dataset.id;
        });
    });

    document.querySelectorAll('.edit-button').forEach(button => {
        button.addEventListener('click', function(e) {
            const bookData = JSON.parse(this.dataset.id);
            document.getElementById('edit-form-id').value = bookData.ISBN;
            document.getElementById('edit-form-isbn').value = bookData.ISBN;
            document.getElementById('edit-form-title').value = bookData.Title;
            document.getElementById('edit-form-author').value = bookData.Author;
            document.getElementById('edit-form-genre').value = bookData.Genre;
            document.getElementById('edit-form-publication-year').value = bookData.PublicationYear;
            document.getElementById('edit-form-quantity-available').value = bookData.QuantityAvailable;
            document.getElementById('edit-form-quantity-total').value = bookData.QuantityTotal;
        });
    });
</script>