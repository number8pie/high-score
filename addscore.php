<?php 

$host = "localhost";
$username = "lee";
$password = "lee1";
$database = "high_score";
define('GW_UPLOADPATH', 'img/');

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
        <h1>Guitar Wars</h1>
        <h2>Add Your High Score</h2>
      </div>
    </div>

    <div class="row">
      <div class="large-12 columns">
        <?php
          if (isset($_POST['submit'])) {
            // Grab the score data from the POST
            $name = $_POST['name'];
            $score = $_POST['score'];
            $screenshot = $_FILES['screenshot']['name'];

            if (!empty($name) && !empty($score) && !empty($screenshot)) {
              // Move the fileto the target upload folder
              $target = GW_UPLOADPATH . $screenshot;
              if (move_uploaded_file($_FILES['screenshot']['tmp_name'], $target)) {
                // Connect to the database
                $dbc = mysqli_connect("$host", "$username", "$password", "$database");

                // Write the data to the database
                $query = "INSERT INTO guitar_wars VALUES (0, NOW(), '$name', '$score', '$screenshot')";
                mysqli_query($dbc, $query);

                // Confirm success with the user
                echo '<p>Thanks for adding your new high score!</p>';
                echo '<p><strong>Name:</strong> ' . $name . '<br />';
                echo '<strong>Score:</strong> ' . $score . '</p>';
                echo '<img class="conf-img" src="' . GW_UPLOADPATH . $screenshot . '" alt="Score Image." />';
                echo '<p><a href="index.php">&lt;&lt; Back to high scores</a></p>';

                // Clear the score data to clear the form
                $name = "";
                $score = "";

                mysqli_close($dbc);
              }
            }
            else {
              echo '<p class="error">Please enter all of the information to add your high score.</p>';
            }
          }
        ?>
      </div>
    </div>

    <div class="row">
      <div class="large-6 large-offset-3 columns">
      <hr>
        <form enctype="multipart/form-data" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
          <input type="hidden" name="MAX_FILE_SIZE" value="32768" />
          <label for="name">Name:</label>
          <input type="text" id="name" name="name" value="<?php if (!empty($name)) echo $name; ?>" />
          <label for="score">Score:</label>
          <input type="text" id="score" name="score" value="<?php if (!empty($score)) echo $score; ?>" />
          
          <label for="screenshot">Screen Shot:</label>
          <input type="file" id="screenshot" name="screenshot" value="<?php if (!empty($screenshot)) echo $screenshot; ?>" />

          <input class="button" type="submit" value="Add" name="submit" />
        </form>
      </div>
    </div>

    <script src="js/vendor/jquery.min.js"></script>
    <script src="js/vendor/what-input.min.js"></script>
    <script src="js/foundation.min.js"></script>
    <script src="js/app.js"></script>
  </body>
</html>
