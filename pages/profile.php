<h1>Profile</h1>

<?php 
	
	require_once('../functions/getUser.php');

	global $user;
	global $currentPage;
	$currentPage = -1;

	$uid = $_GET['uid'];
	$userInfo = getUser($uid);

?>

<form> 
	<label>Username</label>
	<input type="text" name="newUname" value="<?php echo $userInfo['uname']; ?>" class="input-xlarge" disabled />
	<label>First Name</label>
	<input type="text" name="newFname" value="<?php echo $userInfo['fname']; ?>" class="input-xlarge" />
	<label>Last Name</label>
	<input type="text" name="newLname" value="<?php echo $userInfo['lname']; ?>" class="input-xlarge" />
	<label>Email</label>
	<input type="text" name="newEmail" value="<?php echo $userInfo['email']; ?>" class="input-xlarge" />
	<br /><br />
	<button class="btn btn-primary">Save changes</button>
</form>

<form>
	<label>Old Password</label>
	<input type="password" name="oldPwd" class="input-xlarge" />
	<label>New Password</label>
	<input type="password" name="newPwd" class="input-xlarge" />
	<label>Repeat New Password</label>
	<input type="password" name="newPwdR" class="input-xlarge" />
	<br /><br />
	<button class="btn btn-primary">Change Password</button>
</form>

<script type="text/javascript">
	$(document).ready(function() {
		$('#profileDetails').submit(function(e) {
			e.preventDefaut();

			$.ajax({
				type: "POST",
				url: '../functions/changeProfile.php',
				data: {
					fname:$("#newFname").val(),
					lname:$("#newLname").val(),
					email:$("#newEmail").val()
				},
				//success: function(data) {
				//	alert('Changes saved');
				//}
			});
		});
	});
</script>