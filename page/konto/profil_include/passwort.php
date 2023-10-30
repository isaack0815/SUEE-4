<?php

$content = array();

$content['head'] = '
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">'. $_SESSION[$_SESSION['lang']]['profil_button_passwort'] .'</button>
    </li>
';
$content['body'] = '
    <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
        <form method="post" action="">
            <div class="mb-3">
                <label for="passwort1" class="form-label">'. $_SESSION[$_SESSION['lang']]['NEW_PASSWORT'] .'</label>
                <input type="password" class="form-control" id="passwort1" name="passwort1">
            </div>
            <div class="mb-3">
                <label for="passwort2" class="form-label">'. $_SESSION[$_SESSION['lang']]['NEW_PASSWORT_REPEAT'] .'</label>
                <input type="password" class="form-control" id="passwort2" name="passwort2">
            </div>
            <br>
            <input type="submit" name="run[SetNewPass]" class="btn btn-primary" value="'. $_SESSION[$_SESSION['lang']]['PROFIL_BUTTON_SAVE_NEW_PASS'] .'">
        </form>
    </div>';

?>

