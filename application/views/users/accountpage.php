<?php $this->view('headers/default_header') ?>
<body>
    <div class="container">
        <h2>Account</h2>
        Hello. Here are your currently checked out items.
        <br>
        <br>
        
        <ul class="collapsible">
            <li>
            <div class="collapsible-header"><i class="material-icons">book</i>Books</div>
            <div class="collapsible-body grey lighten-4"><span>
                <?php $this->view('books/deadlines'); ?>
            </span></div>
            </li>
            <li>
            <div class="collapsible-header"><i class="material-icons">create</i>Articles/Journals</div>
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

        
        <?php if ($logged_in) { ?>
                <li><a href="<?php echo site_url('/checkouthistory'); ?>">View Checkout History</a></li>
        <?php } ?>

        <?php if ($logged_in) { ?>
                <li><a href="<?php echo site_url('/userinfo'); ?>">View/Edit Account Information</a></li>
        <?php } ?>
        
    </div>
    <script src="<?php echo base_url() . 'js/search.js'; ?>"></script>
</body>
</html>