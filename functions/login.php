<a data-toggle="modal" href="#myModal1" onclick="fixModal('register_modal')">Log in</a>
<div class="login_modal" id="register_modal">
<div class="modal hide fade in" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true" id="myModal1">
    <div class="modal-header">
        <a class="close" data-dismiss="modal" aria-hidden="true">&times;</a>
        <h3 id="myModalLabel1">Log in</h3>
    </div>
    <div class="modal-body">
        <form method="post" action='' name="login_form">
            <p><input type="text" class="span3" name="uname" id="uname" placeholder="Username" autofocus></p>
            <p><input type="password" class="span3" name="pwd" placeholder="Password"></p>
            <p><button type="submit" class="btn btn-primary">Sign in</button>
            </p>
            <p><a href="#">Forgot Password?</a></p>
        </form>
    </div>
    <div class="modal-footer">
        <div class="pull-left">
            If you do not have a user, click the register button.
        </div>
         <a data-toggle="modal" onclick="fixModal('register_modal')" href="#myModal2" class="btn btn-primary">Register</a>
        <a class="close btn btn-info" data-dismiss="modal">Close</a>
    </div>
</div>
</div>