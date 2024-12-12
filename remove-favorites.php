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

// Retrieve the favorites from the cookie
$favorites = getFavoritesFromCookie();

// Check if we need to remove all favorites or a specific one
if (isset($_GET['action']) && $_GET['action'] == 'removeAll') {
    $favorites = []; // Clear all favorites
} elseif (isset($_GET['PaintingID'])) {
    $paintingID = $_GET['PaintingID'];
    unset($favorites[$paintingID]); // Remove the specific favorite
}

// Save the updated favorites to the cookie
saveFavoritesToCookie($favorites);

// Redirect back to the favorites page
header('Location: view-favorites.php');
exit();
?>
