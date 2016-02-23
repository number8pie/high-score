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
    <title>Guitar Wars | High Scores</title>
    <link rel="stylesheet" href="css/foundation.css" />
    <link rel="stylesheet" href="css/app.css" />
  </head>
  <body>

    <div class="row">
      <div class="large-12 columns">
        <h1>Guitar Wars - High Scores</h1>
        <p>Welcome, Guitar Warrior, do you have what it takes to crack the high score list? If so, just <a href="addscore.php">add your own score</a>.</p>
      </div>
    </div>

    <hr>

    <div class="row">
      <div class="large-12 columns">
        <?php
            // Connect to the database
            $dbc = mysqli_connect("$host", "$username", "$password", "$database");
            
            // Retrieve the score data from MySQL
            $query = "SELECT * FROM guitar_wars";
            $data = mysqli_query($dbc, $query);

            // Loop through the array of score data, formatting it as HTML
            echo '<table class="scoretable">';
            while ($row = mysqli_fetch_array($data)) {
            
            // Display the score data
                echo '<tr>';
                echo '<td><span class="score">' . $row['score'] . '</span></td>';
                echo '<td><strong>Name:</strong> ' . $row['name'] . '</td>';
                echo '<td><strong>Date:</strong> ' . $row['date'] . '</td></tr>';
            }
            echo '</table>';
            mysqli_close($dbc);
        ?>
      </div>
    </div>


    <script src="js/vendor/jquery.min.js"></script>
    <script src="js/vendor/what-input.min.js"></script>
    <script src="js/foundation.min.js"></script>
    <script src="js/app.js"></script>
  </body>
</html>
