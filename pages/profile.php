<div>
	<legend>Profile</legend>
</div>

<?php 
	
	require_once('../functions/getUser.php');

	$uid = $_GET['uid'];
	$userInfo = getUser($uid);

?>

<form> 
	<label>Username</label>
	<input type="text" name="newUname" value="<?php echo $userInfo['uname']; ?>" class="input-xlarge" />
	<label>First Name</label>
	<input type="text" name="newFname" value="<?php echo $userInfo['fname']; ?>" class="input-xlarge" />
	<label>Last Name</label>
	<input type="text" name="newLname" value="<?php echo $userInfo['lname']; ?>" class="input-xlarge" />
	<label>Email</label>
	<input type="text" name="newEmail" value="<?php echo $userInfo['email']; ?>" class="input-xlarge" />
</form>

<form>
	<label>Old Password</label>
	<input type="password" name="oldPwd" class="input-xlarge" />
	<label>New Password</label>
	<input type="password" name="newPwd" class="input-xlarge" />
	<label>Repeat New Password</label>
	<input type="password" name="newPwdR" class="input-xlarge" />
</form>