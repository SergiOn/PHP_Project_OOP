<form action="<?=SITE?>news/newsAction" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">News</label>

        <input name="title" type="text" class="form-control" id="title" placeholder="Title" value="">

        <input name="cover" type="file" class="form-control">

        <?php if("0") {?>
        <label id="savepic"><input type="checkbox" name="savepic"> Save the image from the previous article</label>
        <?php }?>

        <textarea name="articletext" type="text" class="form-control" id="articletext" placeholder="Text"></textarea>
  </div>
  <button type="submit" class="btn btn-default" name="submit">Submit</button>
</form>