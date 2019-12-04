<?php
$this->view('headers/default_header');
$web = base_url();
if (getenv('PRODUCTION')) {
    $web = 'https://library4750.herokuapp.com/';
}
$url = $web . 'editinfo';
?>
<body>
    <div class="container">
        <h2>Edit Information
        </h2>
        <br>
        <br>
        <div class="row">
            <input type="hidden" value="<?php echo $url ?>" id="url">
            <div class="input-field col s12">
                <input value="<?php echo $name['name']; ?>" id="name" type="text" name="name">
                <label for="name">Name (First Last)</label>
            </div>
            <div class="input-field col s12">
                <input value="<?php echo $email['email']; ?>" id="email" type="email" name="email">
                <label for="email">Email</label>
            </div>
            <div class="input-field col s12">
                <input id="password" type="password" name="password">
                <label for="password">Password</label>
            </div>
        </div>
        <input type="hidden" name="<?= $csrf['name']; ?>" value="<?= $csrf['hash']; ?>"/>
    </div>
    <div class="fixed-action-btn">
        <a onclick="updateUser()" class="btn-floating btn-large tooltipped"
           id="save-btn" data-position="left" data-tooltip="Save Changes">
            <i class="material-icons">save</i>
        </a>
        <ul>
            <li><a href="<?php echo $web . 'checkouthistory'; ?>" class="btn-floating tooltipped" id="history-btn"
                   data-position="left" data-tooltip="View Checkout History"><i class="material-icons">history</i></a>
            </li>
        </ul>
    </div>
    <script src="<?php echo $web . 'js/search.js' ?>"></script>
    <script src="<?php echo $web . 'js/editUser.js' ?>"></script>
</body>
</html>