<div class="container">
    <h1>Bookshelf</h1>

    <div class="row">
        <div class="col-md-6">
            <h2>Available Books</h2>
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
</div>