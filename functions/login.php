<script type="text/javascript">
$(document).ready(function()
{
     $('#login_form').submit(function(e) {
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: 'classes/loginUser.php',
            async: true,
            data: {
                pwd:$("#pwd").val(),
                uname:$("#uname").val()
            },
            success: function(data)
            {
                if (data === 'login') {
                    $("a[href='#pages']").show();
                    $("a[href='#create']").show();

                    $('#myModal1').modal('hide');
                    ajaxGet('functions/loggedIn.php', 'login');
                }
                else {
                alert('Invalid Credentials');
                }
            }
        });
    });
});
</script>

<a data-toggle="modal" href="#myModal1" onclick="fixModal('login_modal')">Log in</a>
<div class="login_modal" id="login_modal">
    <div class="modal hide fade in" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true" id="myModal1">
        <div class="modal-header">
            <a class="close" data-dismiss="modal" aria-hidden="true">&times;</a>
            <h3 id="myModalLabel1">Log in</h3>
        </div>
        <div class="modal-body">
            <form method="post" id="login_form">
                <p><input type="text" class="span3" name="uname" id="uname" placeholder="Username" autofocus></p>
                <p><input type="password" class="span3" name="pwd" id="pwd" placeholder="Password"></p>
                <input id="user_remember_me" style="float: left; margin-right: 10px;" type="checkbox" name="remember" <?php
                if(isset($_COOKIE['blogRemember']))
                {
                    echo 'checked="checked"';
                    if(isset($_COOKIE['style']))
                    {
                        $_SESSION['style'] = $_COOKIE['style'];
                    }
                }
                else
                {
                    echo '';
                } ?>
                />
                <label class="string optional" for="user_remember_me">Remember me</label>
                <p><button type="submit" value="login" class="btn btn-primary">Sign in</button>
                </p>
                <p><a href="#">Forgot Password?</a></p>
            </form>
        </div>
        <div class="modal-footer">
            <div class="pull-left">
                If you do not have a user, click the register button.
            </div>
             <a data-toggle="modal" onclick="fixModal('register_modal')" data-dismiss="modal" href="#myModal2" class="btn btn-primary">Register</a>
            <a class="close btn btn-info" data-dismiss="modal">Close</a>
        </div>
    </div>
</div>


<script type="text/javascript">
    $(document).ready(function() {
      $('#register_form').submit(function(e) {
        e.preventDefault();
        $.ajax({
           type: "POST",
           url: 'classes/newUser.php',
           data: $(this).serialize(),
           success: function(data)
           {
                if (data === 'success') {
                    $.ajax({
                        type: "POST",
                        url: 'classes/loginUser.php',
                        data: {
                            pwd:$("#regPwd").val(),
                            uname:$("#regUser").val()
                        },
                        success: function(data)
                        {
                            if (data === 'login') {
                                $("a[href='#pages']").show();
                                $("a[href='#create']").show();
                                
                                $('#myModal2').modal('hide');
                                ajaxGet('functions/loggedIn.php', 'login');
                            }
                            else {
                            alert('Invalid Credentials');
                            }
                        }
                    });
                }
                else {
                    alert('Invalid Credentials');
                }
           }
       });
     });
    });
</script>

<a data-toggle="modal" href="#myModal2" onclick="fixModal('register_modal')">Register</a>
<div class="register_modal" id="register_modal">
    <div class="modal hide fade in" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true" id="myModal2">
        <div class="modal-header">
            <a class="close" data-dismiss="modal" aria-hidden="true">&times;</a>
            <h3 id="myModalLabel2">Register</h3>
        </div>
        <div class="modal-body">
            <form method="post" action='' id="register_form">
                <p><input type="text" class="span3" name="regUser" size="30" id="regUser" placeholder="Username" autofocus required></p>
                <p><input type="password" class="span3" name="regPwd" size="30" id="regPwd" placeholder="Password" pattern="(\S{4,10})" required></p>
                <p><input type="password" class="span3" name="regConfirmPwd" size="30" id="regConfirmPwd" placeholder="Confirm password" pattern="(\S{4,10})" required></p>
                <p><button type="submit" class="btn btn-primary">Sign up</button>
                </p>
                <p><a href="#">Forgot Password?</a></p>
            </form>
        </div>
        <div class="modal-footer">
            <div class="pull-left">
                If you already have a user, click log in.
            </div>
             <a data-toggle="modal" onclick="fixModal('login_modal')" data-dismiss="modal" href="#myModal1" class="btn btn-primary">Log in</a>
            <a class="close btn btn-info" data-dismiss="modal">Close</a>
        </div>
    </div>
</div>