<?php
$this->view('headers/default_header');
$web = base_url();
if (getenv('PRODUCTION')) {
    $web = 'https://library4750.herokuapp.com/';
}
?>
<body>
    <div class="container">
        <h2>Account Information
            <a href="<?php echo $web . '/editinfo'; ?>" class="waves-effect grey darken-2 btn"><i
                        class="material-icons left">mode_edit</i>Edit</a>
        </h2>
        <br>
        <br>
        <div class="row">
            <div class="input-field col s12">
                <input disabled value="<?php echo $name['name']; ?>" id="name" type="text" class="validate">
                <label for="name">Name (First Last)</label>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <input disabled value="<?php echo $email['email']; ?>" id="email" type="text" class="validate">
                    <label for="email">Email</label>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <input disabled value="**********" id="password" type="text" class="validate">
                        <label for="password">Password</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="<?php echo $web . 'js/search.js'; ?>"></script>
</body>
</html>