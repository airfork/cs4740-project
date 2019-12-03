<?php
$this->view('headers/default_header');
$web = base_url();
if (getenv('PRODUCTION')) {
    $web = 'https://library4750.herokuapp.com/';
}
?>
<body>
    <div class="container">
        <h2>Checked Out Items</h2>

        <ul class="collapsible">
            <li>
                <div class="collapsible-header"><i class="material-icons">book</i>Books</div>
                <div class="collapsible-body grey lighten-4"><span>
                <?php $this->view('books/deadlines'); ?>
            </span></div>
            </li>
            <li>
                <div class="collapsible-header"><i class="material-icons">note</i>Articles/Journals</div>
                <div class="collapsible-body grey lighten-4"><span>
                <?php $this->view('articles/deadlines'); ?>
            </span></div>
            </li>
            <li>
                <div class="collapsible-header"><i class="material-icons">movie</i>Movies</div>
                <div class="collapsible-body grey lighten-4"><span>
                <?php $this->view('movies/deadlines'); ?>
            </span></div>
            </li>
            <li>
                <div class="collapsible-header"><i class="material-icons">meeting_room</i>Study Spaces</div>
                <div class="collapsible-body grey lighten-4"><span>
                <?php $this->view('spaces/deadlines'); ?>
            </span></div>
            </li>
        </ul>

        <div class="fixed-action-btn">
            <a href="<?php echo $web . 'editinfo'; ?>" class="btn-floating btn-large tooltipped" id="edit-btn"
               data-position="left" data-tooltip="Edit Account">
                <i class="large material-icons">mode_edit</i>
            </a>
            <ul>
                <li><a href="<?php echo $web . 'checkouthistory'; ?>" class="btn-floating tooltipped" id="history-btn"
                       data-position="left" data-tooltip="View Checkout History"><i
                                class="material-icons">history</i></a></li>
            </ul>
        </div>
    </div>
    <script src="<?php echo $web . 'js/search.js' ?>"></script>
</body>
</html>