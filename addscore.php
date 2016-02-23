<?php 

$host = "localhost";
$username = "lee";
$password = "lee1";
$database = "high_score";

?>

<!doctype html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Guitar Wars | Add Your High Score</title>
    <link rel="stylesheet" href="css/foundation.css" />
    <link rel="stylesheet" href="css/app.css" />
  </head>
  <body>

    <div class="row">
      <div class="large-12 columns">
        <h1>Guitar Wars - Add Your High Score</h1>
      </div>
    </div>

    <?php
      if (isset($_POST['submit'])) {
        // Grab the score data from the POST
        $name = $_POST['name'];
        $score = $_POST['score'];

        if (!empty($name) && !empty($score)) {
          // Connect to the database
          $dbc = mysqli_connect('www.guitarwars.net', 'admin', 'rockit', 'gwdb');

          // Write the data to the database
          $query = "INSERT INTO guitarwars VALUES (0, NOW(), '$name', '$score')";
          mysqli_query($dbc, $query);

          // Confirm success with the user
          echo '<p>Thanks for adding your new high score!</p>';
          echo '<p><strong>Name:</strong> ' . $name . '<br />';
          echo '<strong>Score:</strong> ' . $score . '</p>';
          echo '<p><a href="index.php">&lt;&lt; Back to high scores</a></p>';

          // Clear the score data to clear the form
          $name = "";
          $score = "";

          mysqli_close($dbc);
        }
        else {
          echo '<p class="error">Please enter all of the information to add your high score.</p>';
        }
      }
    ?>

    <hr />

    <div class="row">
      <div class="large-12 columns">
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
          <label for="name">Name:</label>
          <input type="text" id="name" name="name" value="<?php if (!empty($name)) echo $name; ?>" /><br />
          <label for="score">Score:</label>
          <input type="text" id="score" name="score" value="<?php if (!empty($score)) echo $score; ?>" />
          <input type="submit" value="Add" name="submit" />
        </form>
      </div>
    </div>

    <script src="js/vendor/jquery.min.js"></script>
    <script src="js/vendor/what-input.min.js"></script>
    <script src="js/foundation.min.js"></script>
    <script src="js/app.js"></script>
  </body>
</html>
