<?php 
session_start();

if(isset($_SESSION['username'])){

}
else{
    echo '<script> alert("You must be logged in to view this page"); 
                   window.location="./registration/login.html"; 
    </script>';
    exit();
}
?>