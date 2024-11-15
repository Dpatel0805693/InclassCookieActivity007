<?php
session_start();

//query info here - if it is in the url then it will create a painting array for it and add to favorites array
if (isset($_GET['PaintingID']) && isset($_GET['ImageFileName']) && isset($_GET['Title'])) 
{
    $paintingID = $_GET['PaintingID'];
    $imageFileName = $_GET['ImageFileName'];
    $title = $_GET['Title'];

    $painting = [ //creates painting array that stores all the data from query
        'PaintingID'=> $paintingID,
        'ImageFileName' => $imageFileName,
        'Title' => $title
    ];

    if(!isset($_SESSION['favorites'])) { // if there is not a favorites array in the current session
        $_SESSION['favorites'] = [];
    }
    
    $_SESSION['favorites'][$paintingID] = $painting; // sets the painting id as its key value

    //checks if favorites list is correct
    /* echo '<pre>';
    print_r($_SESSION['favorites']);
    echo '</pre>'; */
};

// Redirect the user to view favorites php
header('Location: view-favorites.php');
exit();