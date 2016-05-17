	<form action="<?=SITE?>user/authAction.php" method="post" enctype="multipart/form-data">
	  <div class="form-group">
		<label for="title">News</label>
		<input name="title" type="text" class="form-control" id="title" placeholder="Title">

		<input name="cover" type="file" class="form-control">
		
		<textarea name="articletext" type="text" class="form-control" id="articletext" placeholder="Text"></textarea>
	  </div>
	  <button type="submit" class="btn btn-default" name="submit" value="11">Submit</button>
	</form>