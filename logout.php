<?php
include_once ("modules/plugin.php");
if (isset($_SESSION[$_COOKIE['session_id'] ?? false])) {
    $_SESSION[$_COOKIE['session_id']] = null;
}
setcookie("session_id", "", time() - 3600, '/');
header('location: index.php');
?>