<li class="dropdown">
    <a class="dropdown-toggle" href="#" data-toggle="dropdown">Sign Up <strong class="caret"></strong></a>
    <div class="dropdown-menu" style="padding: 15px; padding-bottom: 0px;">
        <form name="signIn" action="index.php" method="post" accept-charset="UTF-8">
            <legend>Sign in</legend>
            <input style="margin-bottom: 15px;" type="text" name="uname" size="30" placeholder="Username" required/>
            <input style="margin-bottom: 15px;" type="password" name="pwd" size="30" placeholder="Password" required/>
            <label class="checkbox">
                <input style="margin-bottom: 15px;" type="checkbox" value="" />
            </label>
            <input class="btn btn-primary" style="clear: left; width: 100%; height: 32px; magin-bottom: 15px; font-size: 13px;" type="submit" value="Sign in" />
        </form>
        <form name="registration" action="index.php" method="post" accept-charset="UTF-8">
            <legend>Register</legend>
            <input style="margin-bottom: 15px;" type="text" name="regUser" size="30" placeholder="Username" required/>
            <input style="margin-bottom: 15px;" type="password" name="regPwd" size="30" placeholder="Password" pattern="(\S{4,10})" required/>
            <input style="margin-bottom: 15px;" type="password" name="regConfirmPwd" size="30" placeholder="Confirm password" pattern="(\S{4,10})" required/>
            <input class="btn btn-primary" style="clear: left; width: 100%; height: 32px; margin-bottom: 15px; font-size: 13px;" type="submit" value="Register" />
        </form>
    </div>
</li>
