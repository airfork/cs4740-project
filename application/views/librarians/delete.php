<?php $this->view('headers/default_header') ?>
<body>
    <div class="container">
        <h2>Delete Items</h2>
        <br>
        <?php
        $this->load->helper('form');
        $this->load->library('form_validation');
        $web = base_url();
        if (getenv('PRODUCTION')) {
            $web = 'https://library4750.herokuapp.com/';
        }
        $url = $web;
        ?>
        <input type="hidden" value="<?php echo $url ?>" id="url">
        <form action="<?php echo $url . 'librarians/delete'; ?>" method="post">
            <div class="row">
                <div class="input-field col s12 m4">
                    <select id="type" name="type">
                        <?php if (!empty($type)) {
                            switch ($type) {
                                case 'movies': ?>
                                    <option value="movies">Movies</option>
                                    <option value="books">Books</option>
                                    <option value="articles">Articles/Journals</option>
                                    <?php break;
                                case 'articles': ?>
                                    <option value="articles">Articles/Journals</option>
                                    <option value="books">Books</option>
                                    <option value="movies">Movies</option>
                                    <?php break;
                                default: ?>
                                    <?php break;
                            }
                        } else { ?>
                            <option value="books">Books</option>
                            <option value="movies">Movies</option>
                            <option value="articles">Articles/Journals</option>
                        <?php } ?>
                    </select>
                    <label for="type">Search Type</label>
                </div>
                <div class="input-field col s12 m8">
                    <input id="search" type="text" name="search" required>
                    <label for="search">Search</label>
                </div>
                <div class="col m4">
                    <button class="btn btn-small" type="submit" id="search-btn">Search
                        <i class="material-icons right">search</i>
                    </button>
                </div>
                <input type="hidden" name="<?= $csrf['name']; ?>" value="<?= $csrf['hash']; ?>" id="csrf"/>
            </div>
        </form>
        <p class="text--center"><?php echo validation_errors() ?></p>
        <?php $this->view('books/delete_results'); ?>
        <?php $this->view('movies/delete_results'); ?>
        <?php $this->view('articles/delete_results'); ?>
    </div>
    <script src="<?php echo $web . 'js/search.js'; ?>"></script>
</body>
</html>