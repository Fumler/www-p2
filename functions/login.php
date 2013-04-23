<a class="btn btn-primary" data-toggle="modal" href="#myModal">Login</a>

<div class="modal hide" id="myModal">
    <div class="modal-header">
        <a class="close" data-dismiss="modal">&times;</a>
        <h3>Login</h3>
    </div>
    <div class="modal-body">
        <form method="post" action="" id="login_form">
            <p><input name="uname" type="text" id="uname" value="" placeholder="Username"/></p>
            <p><input name="pwd" type="password" id="pwd" value="" placeholder="Password"/></p>
        </form>
    </div>
    <div class="modal-footer">
        <a href="javascript:;" onclick="document.getElementById('login_form').submit();" class="btn btn-primary">Login</a>
        <a href="#" class="btn btn-primary">Register</a>
        <a href="#" data-dismiss="modal" class="btn">Close</a>
    </div>
</div>

