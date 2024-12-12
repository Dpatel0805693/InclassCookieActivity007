<?php
// Function to get the favorites from the cookie
function getFavoritesFromCookie() {
    if (isset($_COOKIE['favorites'])) {
        return json_decode($_COOKIE['favorites'], true);
    }
    return [];
}

// Function to save the favorites to the cookie
function saveFavoritesToCookie($favorites) {
    $jsonFavorites = json_encode($favorites);
    setcookie('favorites', $jsonFavorites, time() + (86400 * 30), "/"); // 86400 = 1 day
}

// Query info here - if it is in the URL then it will create a painting array for it and add to favorites array
if (isset($_GET['PaintingID']) && isset($_GET['ImageFileName']) && isset($_GET['Title'])) {
    $paintingID = $_GET['PaintingID'];
    $imageFileName = $_GET['ImageFileName'];
    $title = $_GET['Title'];

    $painting = [ // Creates painting array that stores all the data from query
        'PaintingID' => $paintingID,
        'ImageFileName' => $imageFileName,
        'Title' => $title
    ];

    $favorites = getFavoritesFromCookie(); // Retrieve the current favorites from the cookie

    $favorites[$paintingID] = $painting; // Add or update the painting in the favorites array

    saveFavoritesToCookie($favorites); // Save the updated favorites array back to the cookie
}

// Redirect the user to view favorites PHP
header('Location: view-favorites.php');
exit();
?>
