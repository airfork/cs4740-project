<?php $this->view('headers/default_header') ?>
<body>
    <div class="container">
        <h2>Checkout History</h2>
        <ul class="collapsible">
            <li>
            <div class="collapsible-header"><i class="material-icons">book</i>Books</div>
            <div class="collapsible-body grey lighten-4 center-align"><span>
                <?php $this->view('books/history'); ?>
                <br>
                <a href="<?php echo $web.'download_bookhist'; ?>">Download Checkout History</a>
            </span></div>
            </li>
            <li>
            <div class="collapsible-header"><i class="material-icons">note</i>Articles/Journals</div>
            <div class="collapsible-body grey lighten-4 center-align"><span>
                <?php $this->view('articles/history'); ?>
                <br>
                <a href="<?php echo $web.'download_ajhist'; ?>">Download Checkout History</a>
            </span></div>
            </li>
            <li>
            <div class="collapsible-header"><i class="material-icons">movie</i>Movies</div>
            <div class="collapsible-body grey lighten-4 center-align"><span>
                <?php $this->view('movies/history'); ?>
                <br>
                <a href="<?php echo $web.'download_moviehist'; ?>">Download Checkout History</a>
            </span></div>
            </li>
            <li>
            <div class="collapsible-header"><i class="material-icons">meeting_room</i>Study Spaces</div>
            <div class="collapsible-body grey lighten-4 center-align"><span>
                <?php $this->view('spaces/history'); ?>
                <br>
                <a href="<?php echo $web.'download_studyhist'; ?>">Download Checkout History</a>
            </span></div>
            </li>
        </ul>

        <div class="fixed-action-btn">
            <a href="<?php echo $web.'editinfo'; ?>" class="btn-floating btn-large tooltipped" id="edit-btn" data-position="left" data-tooltip="Edit Account">
                <i class="large material-icons">mode_edit</i>
            </a>
        </div>
        
    </div>
    <script src="<?php echo $web.'js/search.js'?>"></script>
</body>
</html>