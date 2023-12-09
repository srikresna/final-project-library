<div class="container">
    <h1>Bookshelf</h1>

    <div class="row">
        <div class="col-md-6">
            <h2>Available Books</h2>
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
                        <a href="#" class="btn btn-primary">Borrow</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <script>
        document.querySelectorAll('.dropdown-item').forEach(item => {
            item.addEventListener('click', function(e) {
                e.preventDefault();
                document.getElementById('search-input').placeholder = 'Search by ' + this.innerText;
                document.getElementById('search-type').value = this.dataset.type;
            });
        });
    </script>

</div>