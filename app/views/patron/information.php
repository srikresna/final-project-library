<div class="container mt-3">
    <h1 class="fw-bold">Information</h1>
    <br>
    <div class="d-flex flex-row-reverse mb-2">
        <form action="<?= BASE_URL; ?>/patron/information" method="post">
            <button type="submit" class="btn btn-danger" name="deleteButton" value="<?php echo $_SESSION['PatronId']; ?>">
                <i class="bi bi-trash"></i>
            </button>
        </form>
    </div>
    <h5>For You :</h5>
    <hr>
    <?php
    if (empty($data['mail'])) {
        echo '<h5 class="text-center">There is no latest information for you.</h5>';
    } else {
        foreach ($data['mail'] as $m) : ?>
            <div class="card">
                <h5 class="card-header">
                    <?php echo $m['Subject']; ?>
                </h5>
                <div class="card-body">
                    <p class="card-text"><?php echo $m['Body']; ?></p>
                    <footer class="blockquote-footer"><?php echo $m['MailDate']; ?></footer>
                </div>
            </div>
            <br>
    <?php endforeach;
    } ?>
    <h5>Announcement :</h5>
    <hr>
    <?php
    if (empty($data['batchMail'])) {
        echo '<h5 class="text-center">There is no latest information for you.</h5>';
    } else {
        foreach ($data['batchMail'] as $b) : ?>
            <div class="card">
                <h5 class="card-header">
                    <?php echo $b['Subject']; ?>
                </h5>
                <div class="card-body">
                    <p class="card-text"><?php echo $b['Body']; ?></p>
                    <footer class="blockquote-footer"><?php echo $b['MailDate']; ?></footer>
                </div>
            </div>
            <br>
    <?php endforeach;
    } ?>
</div>