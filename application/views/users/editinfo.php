<?php $this->view('headers/default_header') ?>
<body>
    <div class="container">
        <h2>Edit Information
        </h2>
        <br>
        <br>
        <form action="" method="POST" id="edit-form"> 
          <div class="row">
            <div class="input-field col s12">
              <input value="<?php echo $name['name']; ?>" id="name" type="text" name="name">
              <label for="name">Name (First Last)</label>
            </div>
            <div class="input-field col s12">
              <input value="<?php echo $email['email']; ?>" id="email" type="text" name="email">
              <label for="email">Email</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12">
              <input value="**********" id="password" type="text" name="password">
              <label for="password">Password</label>
            </div>
          </div>
          <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
        </form>
    </div>
    <div class="fixed-action-btn">
        <a onclick="document.getElementById('edit-form').submit();" class="btn-floating btn-large tooltipped" id="save-btn" data-position="left" data-tooltip="Save Changes">
            <i class="material-icons">save</i>
        </a>
        <ul>
            <li><a href="<?php echo site_url('/checkouthistory') ?>" class="btn-floating tooltipped" id="history-btn" data-position="left" data-tooltip="View Checkout History"><i class="material-icons">history</i></a></li>
        </ul>
    </div>
    <script src="<?php echo base_url() . 'js/search.js'; ?>"></script>
</body>
</html>