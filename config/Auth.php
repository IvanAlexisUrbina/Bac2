<?php
    if (!$_SESSION['auth']) {
        Helpers\redirect("login.php");
    }
?>