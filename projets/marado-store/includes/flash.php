<?php
if (!empty($_SESSION['flash'])) {
    $flash = $_SESSION['flash'];
    unset($_SESSION['flash']);
    echo '<div class="container" style="padding-top:20px;"><div class="alert alert-' . e($flash['type']) . '">' . $flash['text'] . '</div></div>';
}
