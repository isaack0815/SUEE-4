<?php

return '
    <form method="post" action="">
        <div class="form-group">
            <label for="exampleInputEmail1">' . $_SESSION[$_SESSION['lang']]['LoginEmail'] . '</label>
            <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
            <small id="emailHelp" class="form-text text-muted">' . $_SESSION[$_SESSION['lang']]['LoginEmailHelp'] . '</small>
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">' . $_SESSION[$_SESSION['lang']]['LoginPassword'] . '</label>
            <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
        </div>
        <div class="form-group">
            <label for="exampleInputAutologin">' . $_SESSION[$_SESSION['lang']]['LoginAutoLogin'] . '</label>
            <input type="checkbox" name="autologin" class="form-check-input" id="exampleInputAutologin" value="1">
        </div>
        <br>
        <input type="submit" name="run[login]" value="' . $_SESSION[$_SESSION['lang']]['LoginButton'] . '" class="btn btn-primary">
    </form>
';