<?php
session_start();

$res = isset($_GET['res']) ? $_GET['res'] : '';

if ($res === 'success' && isset($_SESSION['success_message'])) {
    echo '
    <div class="toast fade show" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header bg-success">
            <svg class="bd-placeholder-img rounded me-2" width="20" height="20" xmlns="http://www.w3.org/2000/svg"
                aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false">
                <image href="./img/Logo.svg" width="20" height="20" />
            </svg>
            <strong class="me-auto">Sucesso!</strong>
            <small>11 mins ago</small>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
            ' . $_SESSION['success_message'] . '
        </div>
    </div>';
    unset($_SESSION['success_message']);
} elseif ($res === 'error' && isset($_SESSION['error_message'])) {
    echo '
    <div class="toast fade show" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header bg-danger">
            <svg class="bd-placeholder-img rounded me-2" width="20" height="20" xmlns="http://www.w3.org/2000/svg"
                aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false">
                <image href="./img/Logo.svg" width="20" height="20" />
            </svg>
            <strong class="me-auto">Erro!</strong>
            <small>11 mins ago</small>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
            ' . $_SESSION['error_message'] . '
        </div>
    </div>';
    unset($_SESSION['error_message']);
} else {
    // Lida com o caso em que nenhum resultado foi especificado
    // ou não há mensagem correspondente na sessão
}
