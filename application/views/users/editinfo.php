<?php $this->view('headers/default_header') ?>
<body>
    <div class="container">
        <h2>Account Information
        <a href="<?php echo site_url('/userinfo'); ?>" class="waves-effect grey darken-2 btn"><i class="material-icons left">save</i>Save</a>
        <a href="<?php echo site_url('/userinfo'); ?>" class="waves-effect grey darken-2 btn"><i class="material-icons left">clear</i>Cancel</a>
        </h2>
        <br>
        <br>
          <div class="row">
            <div class="input-field col s12">
              <input placeholder="<?php echo $name['name']; ?>" id="name" type="text" class="validate">
              <label for="name">Name (First Last)</label>
            </div>
            <div class="input-field col s12">
              <input placeholder="<?php echo $email['email']; ?>" id="email" type="text" class="validate">
              <label for="email">Email</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12">
              <input placeholder="**********" id="password" type="text" class="validate">
              <label for="password">Password</label>
            </div>
          </div>
    </div>
    <script src="<?php echo base_url() . 'js/search.js'; ?>"></script>
</body>
</html>