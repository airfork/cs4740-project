<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!--  Icons  -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <title>THE Library</title>
</head>
<body>
    <div class="container">
        <h2>Search</h2>
        <br>
        <?php
        $this->load->helper('form');
        $this->load->library('form_validation');
        $url = site_url('/');
        ?>
        <input type="hidden" value="<?php echo $url ?>" id="url">
        <form action="<?php echo $url.'search'; ?>" method="post">
            <div class="row">
                <div class="input-field col s12 m4">
                    <select id="type">
                        <option value="books">Books</option>
                        <option value="movies">Movies</option>
                        <option value="articles">Articles/Journals</option>
                    </select>
                    <label for="type">Search Type</label>
                </div>
                <div class="input-field col s12 m8">
                    <input placeholder="Input search" id="search" type="search" required>
                    <label for="search">Search</label>
                </div>
                <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" id="csrf"/>
                <button class="btn waves-effect waves-light btn-small" type="submit" name="action">Search
                    <i class="material-icons right">search</i>
                </button>
            </div>
        </form>
        <p class="text--center"><?php echo validation_errors() ?></p>
        <?php
        if (!empty($books)) { ?>
            <h3>Search Results:</h3>
            <table>
                <thead>
                <tr>
                    <th>ISBN</th>
                    <th>Title</th>
                    <th>Author</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($books as $book): ?>
                    <tr onclick="checkout(<?php echo $book['isbn']; ?>)">
                        <td>
                            <?php echo $book['isbn']; ?>
                        </td>
                        <td>
                            <?php echo $book['title']; ?>
                        </td>
                        <td>
                            <?php echo $book['author']; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        <?php } ?>
    </div>
    <script src="<?php echo base_url() . 'js/search.js'; ?>"></script>
</body>
</html>