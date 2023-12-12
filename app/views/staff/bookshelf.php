<div class="container">
    <h1>Bookshelf</h1>

    <div class="row">
        <div class="col-md-6">
            <h2>List of Books</h2>
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
    <table class="table">
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
                        
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="row">
        <div class="btn-primary text-center">
            <a href="<?= BASE_URL; ?>/staff/addBook" class="btn btn-primary">Add Book</a>
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

    </script>
</div>