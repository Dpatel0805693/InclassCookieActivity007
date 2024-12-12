<?php
session_start();
/* if (!isset($_SESSION['favorites'])) {
  $_SESSION['favorites'] = [];
} */
//checks favorites array
/* echo '<pre>';
print_r($_SESSION['favorites']);
echo '</pre>'; */

function getFavoritesFromCookie() {
  if (isset($_COOKIE['favorites'])) {
      return json_decode($_COOKIE['favorites'], true);
  }
  return [];
}

function saveFavoritesToCookie($favorites) {
  $jsonFavorites = json_encode($favorites);
  setcookie('favorites', $jsonFavorites, time() + (86400 * 30), "/"); // 86400 = 1 day
}
$favorites = getFavoritesFromCookie();
?>

<!DOCTYPE html>
<html lang=en>
<head>
<meta charset=utf-8>
    <link href='http://fonts.googleapis.com/css?family=Merriweather' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="css/semantic.js"></script>
  
    
    <link href="css/semantic.css" rel="stylesheet" >
    <link href="css/icon.css" rel="stylesheet" >
    <link href="css/styles.css" rel="stylesheet">
    
    
</head>
<body >
    
<?php include 'includes/art-header.inc.php'; ?>
    
<main class="ui container">
    
    <section class="ui basic segment ">
      <h2>Favorites</h2>
        <table class="ui basic collapsing table">
          <thead>
            <tr>
              <th>Image</th>
              <th>Title</th>
              <th>Action</th>
          </tr></thead>
          <tbody>
  
              <?php 
              if (!empty($favorites)) {
                  foreach ($favorites as $favorite) {
                      echo "<tr>
                              <td><img src='images/art/square-medium/{$favorite['ImageFileName']}.jpg'></td>
                              <td><a href='single-painting.php?id={$favorite['PaintingID']}'>{$favorite['Title']}</a></td>
                              <td><a class='ui small button' href='remove-favorites.php?PaintingID={$favorite['PaintingID']}'>Remove</a></td>
                            </tr>";
                  }
              } else {
                  echo "<tr><td colspan='3'>No favorites found.</td></tr>";
              }
              
              
                
                /* // markup for sample favorite is as follows:
                     <tr>
                        <td><img src="images/art/square-medium/092040.jpg"></td>
                        <td><a href="single-painting.php?id=369">Adoration in the Forest</a></td>
                        <td><a class="ui small button" href="remove-favorites.php?id=369">Remove</a></td>
                     </tr>
                   // loop through all favorites and output a row for each one  
                */
              ?>
          </tbody>
          <tfoot class="full-width">
              <th colspan="3">
                <a class="ui left floated small primary labeled icon button" href="remove-favorites.php?action=removeAll">
                  <i class="remove circle icon"></i> Remove All Favorites
                </a>                  
              </th>
          </tfoot>
         </table>
    </section>

</main>    
    
  <footer class="ui black inverted segment">
      <div class="ui container">footer</div>
  </footer>
</body>
</html>    