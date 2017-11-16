<?php
session_start();

if(!($_SESSION["activo"]==1)){
    header('Location: index.php');
}
?>