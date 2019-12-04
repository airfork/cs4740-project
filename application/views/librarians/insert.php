<?php $this->view('headers/default_header') ?>
<body>
    
    
<?php $this->view('headers/login_header') ?>
<body>
    <?php
    $this->load->helper('form');
    $this->load->library('form_validation');
    $insert_bookurl = site_url('/librarians/insert_book');
    $insert_movieurl = site_url('/librarians/insert_movie');
    $insert_articleurl = site_url('/librarians/insert_article');

    ?>

<?php echo validation_errors(); ?>

<ul class="collapsible">
    <li>
      <div class="collapsible-header"><i class="material-icons">filter_drama</i>Insert Book</div>
      <div class="collapsible-body"><span> 
        <form action="<?php echo $insert_bookurl;?>" method="POST" class="form insert_book">

          <input id="title" type="text" name="title" class="form__input browser-default" placeholder="Title" value="<?php echo set_value('Title') ?>" required>
          <input id="title" type="text" name="author" class="form__input browser-default" placeholder="Author" value="<?php echo set_value('Author') ?>" required>
          <input id="title" type="text" name="ISBN" class="form__input browser-default" placeholder="ISBN" value="<?php echo set_value('ISBN') ?>" required>
          <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
          <input type="submit" value="Insert Book">
          </form>
        </span></div>
      
    </li>
    <li>
      <div class="collapsible-header"><i class="material-icons">place</i>Insert Movie</div>
      <div class="collapsible-body"><span>
      <form action="<?php echo $insert_movieurl;?>" method="POST" class="form insert_movie">

      <input id="title" type="text" name="title" class="form__input browser-default" placeholder="Title" value="<?php echo set_value('Title') ?>" required>
          <input id="title" type="text" name="director" class="form__input browser-default" placeholder="Director" value="<?php echo set_value('Director') ?>" required>
          Release Date: <input id="title" type="date" name="releaseDate" class="form__input browser-default" placeholder="Release Date" value="<?php echo set_value('releaseDate') ?>" required> <br>
          Length: <input id="title" type="number" name="length" class="form__input browser-default" placeholder="Length" value="<?php echo set_value('Length') ?>" required>
          <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
          <input type="submit" value="Insert Movie">   
</form>     
        </span></div>
    </li>
    <li>
      <div class="collapsible-header"><i class="material-icons">whatshot</i>Insert Article</div>
      <div class="collapsible-body"><span> 
      <form action="<?php echo $insert_articleurl;?>" method="POST" class="form insert_article">
        <input id="title" type="text" name="title" class="form__input browser-default" placeholder="Title" value="<?php echo set_value('title') ?>" required>
        <input id="title" type="text" name="AJauthor" class="form__input browser-default" placeholder="Author" value="<?php echo set_value('AJauthor') ?>" required>
        <input id="title" type="date" name="pubDate" class="form__input browser-default" placeholder="Publication Date" value="<?php echo set_value('pubDate') ?>" required>
        <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
        <input type="submit" value="Insert Article">        
        </form>     

           </span></div>
    </li>
  </ul>
        
</body>
<script>M.AutoInit();</script>


</html>