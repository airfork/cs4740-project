<?php $this->view('headers/default_header') ?>
<?php
$this->load->helper('form');
$this->load->library('form_validation');
$web = base_url();
if (getenv('PRODUCTION')) {
    $web = 'https://library4750.herokuapp.com/';
}
$insert_bookurl = $web . 'librarians/insert_book';
$insert_movieurl = $web . 'librarians/insert_movie';
$insert_articleurl = $web . 'librarians/insert_article';
?>

<?php echo validation_errors(); ?>
<div class="container">
    <h2>Add New Items</h2>
    <ul class="collapsible">
        <li>
            <div class="collapsible-header"><i class="material-icons">book</i>Add Book</div>
            <div class="collapsible-body grey lighten-4">
                <span>
                    <form action="<?php echo $insert_bookurl; ?>" method="POST" class="form insert_book">
                        <div class="row">
                            <div class="input-field col s12 m4">
                                <input id="title" type="text" name="title" value="<?php echo set_value('Title') ?>" required>
                                <label for="title">Title</label>
                            </div>
                            <div class="input-field col s12 m4">
                                <input id="author" type="text" name="author" value="<?php echo set_value('Author') ?>" required>
                                <label for="author">Author</label>
                            </div>
                            <div class="input-field col s12 m4">
                                <input id="isbn" type="text" name="ISBN" value="<?php echo set_value('ISBN') ?>" required>
                                <label for="isbn">ISBN</label>
                            </div>
                            <div class="col m4">
                                <button class="btn btn-small gen-btn" type="submit">Add
                                    <i class="material-icons right">add</i>
                                </button>
                            </div>
                        </div>
                        <input type="hidden" name="<?= $csrf['name']; ?>" value="<?= $csrf['hash']; ?>"/>
                    </form>
                </span>
            </div>
        </li>

        <li>
            <div class="collapsible-header"><i class="material-icons">movie</i>Add Movie</div>
            <div class="collapsible-body grey lighten-4">
                <span>
                    <form action="<?php echo $insert_movieurl; ?>" method="POST" class="form insert_movie">
                        <div class="row">
                            <div class="input-field col s12 m6">
                                <input id="m_title" type="text" name="title" value="<?php echo set_value('Title') ?>"
                                       required>
                                <label for="m_title">Title</label>
                            </div>
                            <div class="input-field col s12 m6">
                                <input id="director" type="text" name="director"
                                       value="<?php echo set_value('Director') ?>"
                                       required>
                                <label for="director">Director</label>
                            </div>
                            <div class="input-field col s12 m6">
                                <input id="releaseDate" type="date" name="releaseDate"
                                       value="<?php echo set_value('releaseDate') ?>" required>
                                <label for="releaseDate">Release Date</label>
                            </div>
                            <div class="input-field col s12 m6">
                                <input id="length" type="number" name="length" value="<?php echo set_value('Length') ?>"
                                       required>
                                <label for="length">Length</label>
                            </div>
                            <div class="col m4">
                                <button class="btn btn-small gen-btn" type="submit">Add
                                    <i class="material-icons right">add</i>
                                </button>
                            </div>
                        </div>
                        <input type="hidden" name="<?= $csrf['name']; ?>" value="<?= $csrf['hash']; ?>"/>
                    </form>
                </span>
            </div>
        </li>

        <li>
            <div class="collapsible-header"><i class="material-icons">note</i>Add Article</div>
            <div class="collapsible-body grey lighten-4">
                <span>
                    <form action="<?php echo $insert_articleurl; ?>" method="POST" class="form insert_article">
                        <div class="row">
                            <div class="input-field col s12 m4">
                                <input id="a_title" type="text" name="title" value="<?php echo set_value('title') ?>" required>
                                <label for="a_title">Title</label>
                            </div>
                            <div class="input-field col s12 m4">
                                <input id="ajauthor" type="text" name="AJauthor" value="<?php echo set_value('AJauthor') ?>" required>
                                <label for="ajauthor">Author</label>
                            </div>
                            <div class="input-field col s12 m4">
                                <input id="pubdate" type="date" name="pubDate" value="<?php echo set_value('pubDate') ?>" required>
                                <label for="pubdate">Publication Date</label>
                            </div>
                            <div class="col m4">
                                <button class="btn btn-small gen-btn" type="submit">Add
                                    <i class="material-icons right">add</i>
                                </button>
                            </div>
                        </div>
                        <input type="hidden" name="<?= $csrf['name']; ?>" value="<?= $csrf['hash']; ?>"/>
                    </form>
                </span>
            </div>
        </li>

        <li>
            <div class="collapsible-header"><i class="material-icons">library_add</i>Add Study Space Item</div>
            <div class="collapsible-body grey lighten-4">
                <span>
                    <form action="" method="POST" class="form">
                        <div class="row">
                            <div class="input-field col s12 m6">
                                <input id="type" type="text" name="type" value="" required>
                                <label for="type">Item Type</label>
                            </div>
                            <div class="input-field col s12 m6">
                                <input id="description" type="text" name="description" value="" required>
                                <label for="description">Item Description</label>
                            </div>
                            <div class="col m4">
                                <button class="btn btn-small gen-btn" type="submit">Add
                                    <i class="material-icons right">add</i>
                                </button>
                            </div>
                        </div>
                        <input type="hidden" name="<?= $csrf['name']; ?>" value="<?= $csrf['hash']; ?>"/>
                    </form>
                </span>
            </div>
        </li>
    </ul>
</div>

</body>
<script>M.AutoInit();</script>
</html>