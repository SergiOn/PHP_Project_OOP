<form action="<?=SITE?>news/newsAction" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">News</label>

        <input name="title" type="text" class="form-control" id="title" placeholder="Title" value="<?=$var['title']?>">

        <input name="cover" type="file" class="form-control">

        <label id="savepic"><input type="checkbox" name="savepic" checked> Save the image from the previous article</label>

        <textarea name="articletext" type="text" class="form-control" id="articletext" placeholder="Text"><?=$var['text']?></textarea>
  </div>
  <button type="submit" class="btn btn-default" name="submit" value="<?=$var['id']?>">Submit</button>
</form>