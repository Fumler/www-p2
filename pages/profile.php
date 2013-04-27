<h1>Profile</h1>

<?php 
	session_start();
	require_once('../functions/getUser.php');
	$uid = $_GET['uid'];
	$userInfo = getUser($uid);
?>

<script type="text/javascript">

	$(document).ready(function()
	{
	    pages.currentPage = -1;

	    console.log("profile.php -> currentPage: " + pages.currentPage);
	});
</script>

<form> 
	<label>Username</label>
	<input type="text" id="newUname" value="<?php echo $userInfo['uname']; ?>" class="input-xlarge" disabled />
	<label>First Name</label>
	<input type="text" id="newFname" value="<?php echo $userInfo['fname']; ?>" class="input-xlarge" />
	<label>Last Name</label>
	<input type="text" id="newLname" value="<?php echo $userInfo['lname']; ?>" class="input-xlarge" />
	<label>Email</label>
	<input type="text" id="newEmail" value="<?php echo $userInfo['email']; ?>" class="input-xlarge" />
	<br /><br />
	<button type="button" class="btn btn-primary" onclick="changeProfile();">Save changes</button>
</form>

<form>
	<label>Old Password</label>
	<input type="password" id="oldPwd" class="input-xlarge" />
	<label>New Password</label>
	<input type="password" id="newPwd" class="input-xlarge" />
	<label>Repeat New Password</label>
	<input type="password" id="newPwdR" class="input-xlarge" />
	<br /><br />
	<button type="button" class="btn btn-primary" onclick="changePassword();">Change Password</button>
</form>

<script type="text/javascript">
	// AVERT THINE EYES
	<!-- 
	<?php 
		echo "var uid = " . $uid;
	?>
	//-->

	function changeProfile() {
		var newFname = $('#newFname').val(),
			newLname = $('#newLname').val(),
			newEmail = $('#newEmail').val();

		var url = 'functions/changeProfile.php';

		// post start
		$.post(url, {fname:newFname, lname:newLname, email:newEmail, uid:uid}, 
			function (data){
				if (data == 'success') {
					alert("Success!");
				}
				else {
					alert("Query failed T_T");
				}
		});
		// post end
	}

	function changePassword() {
		var oldPass = $('#oldPwd').val(),
			newPass = $('#newPwd').val(),
			newPassR = $('#newPwdR').val();

		var url = 'functions/changePassword.php';

		//post start
		$.post(url, {oldPwd:oldPass, newPwd:newPass, newPwdR:newPassR, uid:uid}, 
			function (data) {
				if (data == 'success') {
					alert("Password changed!");
					
					resetPwdFields();
				}
				else if (data == 'noChange' || data == 'noMatch') {
					alert("Unable to change password, try again");

					resetPwdFields();
				}
				else {
					alert("Something terrible happened T_T");

					resetPwdFields();
				}
		});
		//post end
	}

	function resetPwdFields() {
		// Resets input fields for passwords
		$('#oldPwd').val("");
		$('#newPwd').val("");
		$('#newPwdR').val("");
	}
</script>