<?php

if (isset($_POST['regUser']) && isset($_POST['regPwd']) && isset($_POST['regConfirmPwd'])) {
    if ($_POST['regPwd'] == $_POST['regConfirmPwd']) {
        $user->newUser($_POST['regUser'], $_POST['regPwd']);
    }
    else {
        $user->error = "<strong>Error:</strong> The passwords don't match";
    }
}
?>