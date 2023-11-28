<?php
session_start();

// Destrua a sessão
session_destroy();

// Redirecione para a página de login
header("Location: index.php");
exit();
?> 