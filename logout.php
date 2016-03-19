<?php
session_start();

if(!isset($_SESSION['user']) && !isset($_SESSION['captain']) && !isset($_SESSION['admin']))
{
 header("Location: index.php");
}


if(isset($_GET['logout']))
{
 session_destroy();
 unset($_SESSION['user']);
 unset($_SESSION['captain']);
 unset($_SESSION['admin']);
 header("Location: index.php");
}
?>