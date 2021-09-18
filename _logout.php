<?php
session_start();
echo "logged out";
session_destroy();
header("Location: /iforum/index.php?logout=true");
?>