<?php
session_start(); #adds to session
if(isset($_GET['PaintingID'])){ #if the query has a specific painting id
    $paintingID = $_GET['PaintingID'];

    foreach($_SESSION['favorites'] as $index =>$favorite){ #go through favories list and remove the painting that was specified
        if ($favorite['PaintingID']==$paintingID){
            unset($_SESSION['favorites'][$index]);
        $_SESSION['favorites'] = array_values($_SESSION['favorites']); // Re-index the array
        break;
        }
    }
}
else{ #if there was not a specific painting ID, then the remove all button was clicked so reset entire favorites list
    $_SESSION['favorites'] = [];
}
header('Location: view-favorites.php'); #go back to view favorites page
exit();