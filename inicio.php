<?php
if(!session_start()) { session_start(); }
if(empty($_SESSION['name']) || empty($_SESSION['email'])) { header("Location: index.php"); }
echo $_SESSION['name'];
echo '<br>';
echo $_SESSION['email'];

?>
<br>
<a href="logout.php">Sair</a>
