<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');

session_start();

require_once 'cont/config.php';
require_once 'cont/lib.php';
require_once 'cont/autoload.php';

deleteOldLogFiles();

?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bootstrap 5 Template</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css">
    <!-- Bootstrap Icons CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css">
</head>
<body>
    <div class="container-fluid" style="margin-top: 25px;">
        <?php echo $NavClass->GetMenu(true); ?>
        <div class="row">
            <?php echo $NavClass->GetMenu(); ?>
            <div class="col">
                <?php $PageClass->GetPage($_GET['page']); ?>
            </div>
        </div>
    </div>

    <!-- Toasts -->
    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
        <div id="toastContainer"></div>
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" ></script>

    <script>
        function showToast(error,meldung) {
            var toastContainer = document.getElementById('toastContainer');
            var bgClass = error ? 'bg-warning' : 'bg-success';
            var toast = `
                <div class="toast align-items-center text-white `+bgClass+` border-0" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="d-flex">
                        <div class="toast-body">`+meldung+`</div>
                        <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                </div>
            `;
            toastContainer.innerHTML += toast;
            var toastElList = [].slice.call(document.querySelectorAll('.toast'));
            var toastList = toastElList.map(function (toastEl) {
                return new bootstrap.Toast(toastEl);
            });
            toastList[toastList.length - 1].show();
        }
    </script>
</body>
</html>
