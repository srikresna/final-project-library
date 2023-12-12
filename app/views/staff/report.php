<div class="tab-pane" id="nama-anggota">
    <form action="<?= BASE_URL; ?>/staff/report?action=patron_name" method="post" target="_blank">
        <div class="form-group">
            <label>Patron Name</label>
            <input type="text" class="form-control" name="patron_name" placeholder="Input Name" required>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-block">Show</button>
        </div>
    </form>
</div>