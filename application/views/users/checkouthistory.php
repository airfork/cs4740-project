<?php $this->view('headers/default_header') ?>
<body>
    <div class="container">
        <h2>Checkout History</h2>
        <br>
        <br>
        <ul class="collapsible">
            <li>
            <div class="collapsible-header"><i class="material-icons">book</i>Books</div>
            <div class="collapsible-body grey lighten-4"><span>
                <?php $this->view('books/history'); ?>
                <br>
                <a href="<?php echo site_url('download_bookhist'); ?>">Download Book Checkout History</a>
            </span></div>
            </li>
            <li>
            <div class="collapsible-header"><i class="material-icons">create</i>Articles/Journals</div>
            <div class="collapsible-body grey lighten-4"><span>
                <?php $this->view('articles/history'); ?>
                <br>
                <a href="<?php echo site_url('download_ajhist'); ?>">Download Articles/Journals Checkout History</a>
            </span></div>
            </li>
            <li>
            <div class="collapsible-header"><i class="material-icons">movie</i>Movies</div>
            <div class="collapsible-body grey lighten-4"><span>
                <?php $this->view('movies/history'); ?>
                <br>
                <a href="<?php echo site_url('download_moviehist'); ?>">Download Movies Checkout History</a>
            </span></div>
            </li>
            <li>
            <div class="collapsible-header"><i class="material-icons">meeting_room</i>Study Spaces</div>
            <div class="collapsible-body grey lighten-4"><span>
                <?php $this->view('spaces/history'); ?>
                <br>
                <a href="<?php echo site_url('download_studyhist'); ?>">Download Study Space Checkout History</a>
            </span></div>
            </li>
        </ul>
        
    </div>
    <script src="<?php echo base_url() . 'js/search.js'; ?>"></script>
</body>
</html>