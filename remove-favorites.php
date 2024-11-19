<?php
session_start();
if(isset($_GET['PaintingID'])){
    $paintingID = $_GET['PaintingID'];

    foreach($_SESSION['favorites'] as $index =>$favorite){
        if ($favorite['PaintingID']==$paintingID){
            unset($_SESSION['favorites'][$index]);
        $_SESSION['favorites'] = array_values($_SESSION['favorites']); // Re-index the array
        break;
        }
    }
}
else{
    $_SESSION['favorites'] = [];
}
header('Location: view-favorites.php');
exit();