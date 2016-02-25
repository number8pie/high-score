<?php

require_once('auth.php');
require_once('appvars.php');
require_once('connectvars.php');

?>

<!doctype html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Guitar Wars | Approve a High Score</title>
    <link rel="stylesheet" href="css/foundation.css" />
    <link rel="stylesheet" href="css/app.css" />
  </head>
  <body>

    <div class="row">
      <div class="large-12 columns">
        <h1>Guitar Wars</h1>
        <h2>Approve a High Score</h2>
      </div>
    </div>

    <div class="row">
      <div class="large-6 large-offset-3 columns">
				<?php

          if (isset($_GET['id']) && isset($_GET['date']) && isset($_GET['name']) && isset($_GET['score']) && isset($_GET['screenshot'])) {
            //Grab the score data from GET
            $id = $_GET['id'];
            $date = $_GET['date'];
            $name = $_GET['name'];
            $score = $_GET['score'];
            $screenshot = $_GET['screenshot'];
          } elseif (isset($_POST['id']) && isset($_POST['name']) && isset($_POST['score'])) {
            //Grab the score data from the POST
            $id = $_POST['id'];
            $name = $_POST['name'];
            $score = $_POST['score'];
          } else {
            echo '<p class="error">Sorry, no high score was specified for approval.</p>';
          }

          if (isset($_POST['submit'])) {
            if ($_POST['confirm'] == 'Yes') {
              //Connect to database
              $dbc = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

              //Approve score by setting approved in the database
              $query = "UPDATE guitar_wars SET approved = 1 WHERE id = $id";
              mysqli_query($dbc, $query);
              mysqli_close($dbc);

              //Confirm successful authorisation
              echo '<p>The high score of ' . $score . ' for '. $name . ' was approved.</p>';
            } else {
              echo '<p clas="error">Sorry there was a problem approving the high score.</p>';
            }
          } elseif (isset($id) && isset($name) && isset($date) && isset($score)) {
            echo '<p class="center">Are you sure you want to approve the following high score?</p>';
            echo '<table class="approvetable">';
            echo '<tr><td><strong>Name: </strong></td><td>' . $name . '</td></tr>' .
              '<tr><td><strong>Date: </strong></td><td>' . $date . '</td></tr>' .
              '<tr><td><strong>Score: </strong></td><td>' . $score . '</td></tr>';
            echo '<tr><td><strong>Screenshot: </strong></td><td><img src="' . GW_UPLOADPATH . $screenshot . '" width="160" alt="Score image" /></td></tr>';
            echo '</table>';
            echo '<form method="post" action="approve.php">';
            echo '<input type="radio" name="confirm" value="Yes" /> Yes ';
            echo '<input type="radio" name="confirm" value="No" checked="checked" /> No <br />';
            echo '<input type="submit" value="Submit" name="submit" />';
            echo '<input type="hidden" name="id" value="' . $id . '" />';
            echo '<input type="hidden" name="name" value="' . $name . '" />';
            echo '<input type="hidden" name="score" value="' . $score . '" />';
            echo '</form>';
          }

          echo '<p><a href="admin.php">&lt;&lt; Back to admin page.</a></p>';

				?>
 			</div>
    </div>

      <tr>
        <td></td>
        <td></td>
        <td></td>
      </tr>

    <script src="js/vendor/jquery.min.js"></script>
    <script src="js/vendor/what-input.min.js"></script>
    <script src="js/foundation.min.js"></script>
    <script src="js/app.js"></script>
  </body>
</html>
