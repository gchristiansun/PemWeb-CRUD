<?php
session_start();
session_unset();
session_destroy();

setcookie('key1', '', time() - 3600);
setcookie('key2', '', time() - 3600);

header("Location: loginregister.php");
exit;


?>