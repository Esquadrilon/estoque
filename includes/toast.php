<?php
if (isset($_REQUEST['success_message']) || isset($_REQUEST['error_message'])) {
    $toastClass = isset($_REQUEST['success_message']) ? 'bg-success' : 'bg-danger';
    $toastTitle = isset($_REQUEST['success_message']) ? 'Sucesso!' : 'Erro';
    $toastMessage = isset($_REQUEST['success_message']) ? $_REQUEST['success_message'] : $_REQUEST['error_message'];
    
    echo '
    <div id="toast" class="toast fade show position-absolute mt-4 me-4 top-1 end-0 z-3" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="100" data-bs-autohide="true">
        <div class="toast-header ' . $toastClass . '">
            <svg class="bd-placeholder-img rounded me-2" width="20" height="20" xmlns="http://www.w3.org/2000/svg"
                aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false">
                <image href="\estoque\img\logo.svg" width="20" height="20" />
            </svg>
            <strong class="me-auto">' . $toastTitle . '</strong>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body bg-dark">
            ' . $toastMessage . '
        </div>
    </div>';

    echo '
    <script>
        setTimeout(function() {
            var myToast = document.getElementById("toast");
            var bsToast = new bootstrap.Toast(myToast);
            bsToast.hide();
        }, 2000); // Adjust the delay (in milliseconds) as needed
    </script>';
}
?>
