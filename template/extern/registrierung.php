<div class="card">
    <div class="card-header">Registrierung</div>
    <div class="card-body">
        <form method="post" action="">
            <?php echo $RegForm; ?>
            <br>
            <input type="submit" name="run[registrierung]" value="<?php echo $_SESSION[$_SESSION['lang']]['RegestryButton'];?>" class="btn btn-primary">
        </form>
    </div>
</div>