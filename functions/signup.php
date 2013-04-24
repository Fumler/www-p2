<a data-toggle="modal" href="#myModal2" onclick="fixModal('login_modal')">Register</a>
<div class="register_modal" id="register_modal">
<div class="modal hide fade in" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true" id="myModal2">
    <div class="modal-header">
        <a class="close" data-dismiss="modal" aria-hidden="true">&times;</a>
        <h3 id="myModalLabel2">Register</h3>
    </div>
    <div class="modal-body">
        <form method="post" action='' name="register_form">
            <p><input type="text" class="span3" name="regUser" id="regUser" placeholder="Username" autofocus></p>
            <p><input type="password" class="span3" name="regPwd" placeholder="Password"></p>
            <p><input type="password" class="span3" name="regConfirmPwd" placeholder="Confirm password"></p>
            <p><button type="submit" class="btn btn-primary">Sign up</button>
            </p>
            <p><a href="#">Forgot Password?</a></p>
        </form>
    </div>
    <div class="modal-footer">
        <div class="pull-left">
            If you already have a user, click log in.
        </div>
         <a data-toggle="modal" onclick="fixModal('login_modal')" href="#myModal1" class="btn btn-primary">Log in</a>
        <a class="close btn btn-info" data-dismiss="modal">Close</a>
    </div>
</div>
</div>