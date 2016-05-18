<?php
session_start();
session_unset(); 
// destroy the session 
session_destroy(); 
echo "<script type='text/javascript'>alert('You have logged out.');window.location.href = 'form-login.html';</script>";
?>