<?php $this->view('headers/default_header') ?>
<body>
    <div class="container">
        <h2>Account Information
        <a onclick="document.getElementById('edit-form').submit();" class="waves-effect grey darken-2 btn"><i class="material-icons left">save</i>Save</a>
        <a href="<?php echo site_url('/userinfo'); ?>" class="waves-effect grey darken-2 btn"><i class="material-icons left">clear</i>Cancel</a>
        </h2>
        <br>
        <br>
        <form action="" method="POST" id="edit-form"> 
          <div class="row">
            <div class="input-field col s12">
              <input value="<?php echo $name['name']; ?>" id="name" type="text" class="validate" name="name">
              <label for="name">Name (First Last)</label>
            </div>
            <div class="input-field col s12">
              <input value="<?php echo $email['email']; ?>" id="email" type="text" class="validate" name="email">
              <label for="email">Email</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12">
              <input value="**********" id="password" type="text" class="validate" name="password">
              <label for="password">Password</label>
            </div>
          </div>
          <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
        </form>
    </div>
    <script src="<?php echo base_url() . 'js/search.js'; ?>"></script>
</body>
</html>