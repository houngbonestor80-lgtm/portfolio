<?php
require_once __DIR__ . '/../includes/init.php';
unset($_SESSION['admin_id'], $_SESSION['admin_name']);
redirect('/admin/login.php');
