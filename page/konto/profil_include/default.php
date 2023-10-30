<?php

$row = $this->db->get_row("SELECT * FROM user WHERE user_id = '".$_SESSION['user_id']."'",true);

$content = array();

$content['head'] = '
    <li class="nav-item" role="presentation">
        <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">'. $_SESSION[$_SESSION['lang']]['profil_button_home'] .'</button>
    </li>';
$content['body'] = '
    <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
        <form method="post"" action="">
            <div class="mb-3">
                <label for="username" class="form-label">'. $_SESSION[$_SESSION['lang']]['profil_label_username'] .'</label>
                <input type="text" class="form-control" id="username" name="username" value="'. $row->user_nick .'">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">'. $_SESSION[$_SESSION['lang']]['profil_label_email'] .'</label>
                <input type="email" class="form-control" id="email" name="email" value="'. $row->user_mail .'">
            </div>
            <div class="mb-3">
                <label for="user_name" class="form-label">'. $_SESSION[$_SESSION['lang']]['profil_label_name'] .'</label>
                <input type="text" class="form-control" id="user_name" name="user_name" value="'. $row->user_name .'" disabled>
            </div>
            <div class="mb-3">
                <label for="user_vorname" class="form-label">'. $_SESSION[$_SESSION['lang']]['profil_label_surname'] .'</label>
                <input type="text" class="form-control" id="user_vorname" name="user_vorname" value="'. $row->user_vorname .'" disabled>
            </div>
            <br>
            <input type="submit" name="run[SaveDefaultProfil]" class="btn btn-primary" value="'. $_SESSION[$_SESSION['lang']]['profil_button_save'] .'">
        </form>
    </div>';

?>