<?php
$_SESSION['loggedin'] = false;
session_start();
session_destroy();
header('Location: /login/index');
