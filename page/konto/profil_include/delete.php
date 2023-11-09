<?php

$content['head'] = '
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">'. $_SESSION[$_SESSION['lang']]['PROFIL_DELETE_NAV_TITEL'] .'</button>
    </li>';

$content['body'] = '
    <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
        <form method="post" action="">
            <div class="mb-3">
                <label for="passwort" class="form-label">'. $_SESSION[$_SESSION['lang']]['PROFIL_DELETE_PASSWORT'] .'</label>
                <input type="password" class="form-control" id="passwort" name="passwort">
            </div>
            <br>
            <input type="submit" name="run[DeleteUser]" class="btn btn-primary" value="'. $_SESSION[$_SESSION['lang']]['PROFIL_BUTTON_DELETE'] .'">
        </form>
    </div>';

?>