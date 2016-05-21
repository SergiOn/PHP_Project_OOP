	<form action="<?=SITE?>news/newsAction" method="post" enctype="multipart/form-data">
	  <div class="form-group">
		<label for="title">News</label>
		<input name="title" type="text" class="form-control" id="title" placeholder="Title" value="123">

		<input name="cover" type="file" class="form-control" value="12345">
		
		<textarea name="articletext" type="text" class="form-control" id="articletext" placeholder="Text"></textarea>
	  </div>
	  <button type="submit" class="btn btn-default" name="submit">Submit</button>
	</form>