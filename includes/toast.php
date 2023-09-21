<?php

if (isset($_REQUEST['success_message'])) {
    echo '
    <div class="toast fade show position-absolute mt-4 me-4 top-1 end-0 z-3" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header bg-success">
            <svg class="bd-placeholder-img rounded me-2" width="20" height="20" xmlns="http://www.w3.org/2000/svg"
                aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false">
                <image href="\estoque\img\logo.svg" width="20" height="20" />
            </svg>
            <strong class="me-auto">Sucesso!</strong>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body bg-dark">
            ' . $_REQUEST['success_message'] . '
        </div>
    </div>';
} elseif (isset($_REQUEST['error_message'])) {
    echo
    '
    <div class="toast fade show position-absolute mt-4 me-4 top-1 end-0 z-3" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header bg-danger">
            <svg class="bd-placeholder-img rounded me-2" width="20" height="20" xmlns="http://www.w3.org/2000/svg"
                aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false">
                <image href="\estoque\img\logo.svg" width="20" height="20" />
            </svg>
            <strong class="me-auto">Erro!</strong>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body bg-dark">
            ' . $_REQUEST['error_message'] .
    '
        </div>
    </div>';
} else {
    return null;
}
