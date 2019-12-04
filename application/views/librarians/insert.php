<?php $this->view('headers/default_header') ?>
<?php
$this->load->helper('form');
$this->load->library('form_validation');
$web = base_url('/');
if (getenv('PRODUCTION')) {
    $web = 'https://library4750.herokuapp.com/';
}

?>

<?php echo validation_errors(); ?>
<div class="container">
    <h2>Add New Items</h2>
    <input type="hidden" id="url" value="<?php echo $web; ?>"/>
    <ul class="collapsible">
        <li>
            <div class="collapsible-header"><i class="material-icons">book</i>Add Book</div>
            <div class="collapsible-body grey lighten-4">
                <span>
                    <div class="row">
                        <div class="input-field col s12 m4">
                            <input class="input" id="title" type="text" required>
                            <label for="title">Title</label>
                        </div>
                        <div class="input-field col s12 m4">
                            <input class="input" id="author" type="text" required>
                            <label for="author">Author</label>
                        </div>
                        <div class="input-field col s12 m4">
                            <input class="input" id="isbn" type="text" required>
                            <label for="isbn">ISBN</label>
                        </div>
                        <div class="col m4">
                            <button class="btn btn-smal gen-btn" onclick="addBook()">Add
                                <i class="material-icons right">add</i>
                            </button>
                        </div>
                    </div>
                    <input type="hidden" name="<?= $csrf['name']; ?>" value="<?= $csrf['hash']; ?>"/>
                </span>
            </div>
        </li>

        <li>
            <div class="collapsible-header"><i class="material-icons">movie</i>Add Movie</div>
            <div class="collapsible-body grey lighten-4">
                <span>
                    <div class="row">
                        <div class="input-field col s12 m6">
                            <input class="input" id="m_title" type="text" required>
                            <label for="m_title">Title</label>
                        </div>
                        <div class="input-field col s12 m6">
                            <input class="input" id="director" type="text" required>
                            <label for="director">Director</label>
                        </div>
                        <div class="input-field col s12 m6">
                            <input class="input" id="releaseDate" type="date" required>
                            <label for="releaseDate">Release Date</label>
                        </div>
                        <div class="input-field col s12 m6">
                            <input class="input" id="length" type="number" required>
                            <label for="length">Length</label>
                        </div>
                        <div class="col m4">
                            <button class="btn btn-small gen-btn" onclick="addMovie()">Add
                                <i class="material-icons right">add</i>
                            </button>
                        </div>
                    </div>
                    <input type="hidden" name="<?= $csrf['name']; ?>" value="<?= $csrf['hash']; ?>"/>
                </span>
            </div>
        </li>

        <li>
            <div class="collapsible-header"><i class="material-icons">note</i>Add Article</div>
            <div class="collapsible-body grey lighten-4">
                <span>
                    <div class="row">
                        <div class="input-field col s12 m4">
                            <input class="input" id="a_title" type="text" required>
                            <label for="a_title">Title</label>
                        </div>
                        <div class="input-field col s12 m4">
                            <input class="input" id="ajauthor" type="text" required>
                            <label for="ajauthor">Author</label>
                        </div>
                        <div class="input-field col s12 m4">
                            <input class="input" id="pubdate" type="date" required>
                            <label for="pubdate">Publication Date</label>
                        </div>
                        <div class="col m4">
                            <button class="btn btn-small gen-btn" onclick="addArticle()">Add
                                <i class="material-icons right">add</i>
                            </button>
                        </div>
                    </div>
                    <input type="hidden" name="<?= $csrf['name']; ?>" value="<?= $csrf['hash']; ?>"/>
                </span>
            </div>
        </li>
    </ul>
</div>

</body>
<script src="<?php echo $web . 'js/add.js'; ?>"></script>
</html>