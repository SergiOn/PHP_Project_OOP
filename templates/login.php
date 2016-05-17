	<form action="<?=SITE?>user/authAction" method="post">
	  <div class="form-group">
		<label for="exampleInputEmail1">Email address</label>
		<input name="email" type="email" class="form-control" id="exampleInputEmail1" placeholder="Email">
	  </div>
	  <div class="form-group">
		<label for="exampleInputPassword1">Password</label>
		<input name="pass" type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
	  </div>
	  <div class="checkbox">
		<label>
		  <input type="checkbox" name="check"> Check me out
		</label>
	  </div>
	  <button type="submit" class="btn btn-default">Submit</button>
	</form>