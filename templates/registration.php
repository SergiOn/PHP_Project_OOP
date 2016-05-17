<form action="<?=SITE?>user/regAction" method="post" enctype="multipart/form-data">
	  <div class="form-group">
		<label for="exampleInputEmail1">Email address</label>
		<input name="email" type="email" class="form-control" id="exampleInputEmail1" placeholder="Email">
	  </div>
	  <div class="form-group">
		<label for="exampleInputName">Name</label>
		<input name="name" type="text" class="form-control" id="exampleInputName" placeholder="Name">
	  </div>
	  <div class="form-group">
		<label for="exampleInputLName">Last Name</label>
		<input name="l_name" type="text" class="form-control" id="exampleInputLName" placeholder="Last Name">
	  </div>
	  <div class="form-group">
		<label for="exampleInputPhone">Phone</label>
		<input name="phone" type="phone" class="form-control" id="exampleInputPhone" placeholder="Phone">
	  </div>
	  <div class="form-group">
		<label for="exampleInputBDate">Birthdate</label>
		<input name="birthdate" type="date" class="form-control" id="exampleInputBDate" placeholder="Birthdate">
	  </div>
	  <div class="form-group">
		<label for="exampleInputCity">City</label>
		<select name="city">
			<?php foreach ($var as $city) { ?>
				<option value="<?=$city['id'];?>"><?=$city['name'];?></option>
			<?php } ?>
		</select>
	  </div>
	  <div class="form-group">
		<label for="exampleInputAvatar">Avatar</label>
		<input name="avatar" type="file" class="form-control" id="exampleInputAvatar" placeholder="Avatar">
	  </div>
	  <div class="form-group">
		<label for="exampleInputPassword1">Password</label>
		<input name="pass" type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
	  </div>
	  <div class="form-group">
		<label for="exampleInputPassword2">Confirm password</label>
		<input name="confirmPass" type="password" class="form-control" id="exampleInputPassword2" placeholder="Password">
	  </div>
	  <div class="checkbox">
		<label>
		  <input type="checkbox" name="check"> Check me out
		</label>
	  </div>
	  <button type="submit" class="btn btn-default">Submit</button>
</form>