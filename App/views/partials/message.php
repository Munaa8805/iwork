<?php if (isset($_SESSION['flash'])) : ?>
    <div class="message bg-green-100 p-3 my-3">
        <?= $_SESSION['flash']; ?>
    </div>

    <?php unset($_SESSION['flash']); ?>
<?php endif; ?>

<?php if (isset($_SESSION['error_message'])) : ?>
    <div class="message bg-red-100 p-3 my-3">
        <?= $_SESSION['error_message']; ?>
    </div>

    <?php unset($_SESSION['error_message']); ?>
<?php endif; ?>