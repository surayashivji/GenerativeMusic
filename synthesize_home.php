<?php
session_start();
?>
<html>
<head>
  <title>Home</title>
  <link rel="icon" type="image/png" href="favicon.png">
  <link href="https://fonts.googleapis.com/css?family=Inconsolata" rel="stylesheet">
  <link rel="stylesheet" href="styles/synthesize_home_styles.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/processing.js/1.6.3/processing.min.js"></script>
  <script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-93512293-1', 'auto');
    ga('send', 'pageview');

  </script>
</head>

<style>
.title {
  color: #82caed;
  font-size: 20pt;
}
#canvass{
    overflow: hidden;
    width:100%;
    border:none;
    height:100%;
    position:absolute;
    z-index:-1;
}
.cuteform-elt.cuteform-selected {
  border-width: 4px;
  border-style: solid;
  border-color: white;
}
.header-temp{
  color:#82caed;
  font-family: 'Letter Gothic Std';
  font-size: 19pt;
  text-align:center;
  opacity:0.7;
}
.header-temp-body {
  color:#ed82ca;
  font-family: 'Letter Gothic Std';
  font-size: 15pt;
  margin-left:20%;
  opacity:0.7;
  font-weight:900;
}
.header-temp-body-col {
  color:#ed82ca;
  font-family: 'Letter Gothic Std';
  font-size: 13pt;
  width: 100%;
  margin-left:20%;
  opacity:0.7;
}

/* SOUNDCLOUD URL BOX STYLING */
#inputURL {
  width:250px;
  height: 30px;
  opacity:0.8;
  border: 1px solid #82caed;
  background:none;
  font-family: 'Letter Gothic Std';
  font-size: 12pt;
  padding: 2px;
  color: #82caed;
  padding-left: 7px;
}
#inputURL {
  position: relative;
  margin-left:50px;
}
#submit {width: 250px;
  height: 30px;
  border: none;
  background:none;
  font-family: 'Letter Gothic Std';
  font-size: 12pt;
  padding: 2px;
  color: #82caed;
  opacity: 0.7;
  margin-left: 60px;
}
#submit:hover {
  width: 250px;
  height: 30px;
  border: none;
  background:none;
  font-family: 'Letter Gothic Std';
  font-size: 12pt;
  padding: 2px;
  color: #82caed;
  cursor:pointer;
  font-style: italic;
  opacity: 1;
  margin-left: 60px;
}
</style>

<body style="background-color: #201d1b;margin:0;
font-family: 'Letter Gothic Std';
">

<div id="outercontainer">
  <canvas id="canvass" data-processing-sources="portfoliobg.pde" >

  </canvas>
  <center>
    <div id="nav">
      <ul>
        <li><a href="temphome.php">Home</a></li>
        <li><a href="match.php">Match</a></li>
      </ul>
    </div>
    <div id="profileTitle" style="color:white;">
      <img src="assets/home/profile_title.png"/>
    </div>
    <br><br>
    <?php
    if(empty($_REQUEST['recordid'])) {
      //       echo $_SESSION['sessionUserID'
      $conn = mysqli_connect("uscitp.com", "jahaberm", "8787266053", "jahaberm_synthesize");

      if(mysqli_connect_errno()) {
        echo "Failed to connect to mySql: " . mysqli_connect_errno();
        exit();
      }

      $sql = 	"SELECT * FROM User WHERE user_id =" . $_SESSION['sessionUserID'];
      $results = mysqli_query($conn, $sql);

      if(!$results) {
        echo "<p style='color:white'>Please log in! :) </p>";
        exit();
      }

      while($currentrow = mysqli_fetch_array($results)) {
        ?>

        <div id="jamie">
          <?php
          // $image = $currentrow['image'];
          //                    echo $image;
          //                    echo " <img src=assets/'" . $currentrow['image'] . "'>";
          //                    echo " <img src=assets/camera@2x.png>";
          // echo "<img src=http://shivji.student.uscitp.com/SynthesizeFinal/assets/$image>";
          //                    echo "<img src=http://shivji.student.uscitp.com/SynthesizeFinal/assets/camera@2x.png>";

          ?>

        </div>

        <div class="title">
          <?php
          echo $currentrow['firstname'] . ' ';
          echo $currentrow['lastname'];
          ?>

        </div>

        <br>


        <div class="title">
          <em>
            <?php
            echo $currentrow['username'];
            ?></em></div>

            <br>

            <div class="title">

              <?php
              echo $currentrow['email'];
              ?></div>

              <br>


              <?php

            }

            ?>
            <!--         SAVED SKETCHES CURRENT LOGGED IN USER-->
            <?php
            $conn = mysqli_connect("uscitp.com", "jahaberm", "8787266053", "jahaberm_synthesize");
            if (mysqli_connect_errno()) {
              echo "Failed to connect to mySQL: " . mysqli_connect_errno();
              exit();
            }
            ?>

            <form action="loadSketchProf.php">
              <!--    <form action="loadSketch.php">-->
              <div style="margin-left:auto;margin-right:auto;text-align:center">
                <select class="test" name="sketch" data-cuteform="true">
                  <?php
                  $currentUser = $_SESSION['sessionUserID'];
                  $sql = "SELECT * FROM FavoriteSketches WHERE user_id = $currentUser";
                  $results = mysqli_query($conn, $sql);
                  if(!$results) {
                    echo "Your SQL: " . $sql . "<br><br>";
                    echo "SQL Error: " . mysqli_error($conn);
                    exit();
                  }
                  while($currentrow = mysqli_fetch_array($results)) {
                    $matchingURL = $currentrow['url'];
                    $sketchID = $currentrow['sketch_id'];
                    $thumbnail = getThumbnail($sketchID);
                    $name = getName($sketchID);

                    // value for option should be

                    echo "<option value='" . $name . "' data-cuteform-image='assets/SketchThumbnails/" . $thumbnail . "'></option>";

                  }

                  ?>
                </select>
                <div style="margin: 50px 0 50px 0"></div>
              </div>
              <center>
                <input type="hidden" name="inputURL" value="<?php echo $matchingURL; ?>"><br>


                <div style="margin-bottom:7px;"></div>
                <input id="submit" type="submit" value="View Visualization">
              </center>
            </form>

            <?php


          } else {

            $conn = mysqli_connect("uscitp.com", "jahaberm", "8787266053", "jahaberm_synthesize");


            $sql = "SELECT * FROM User WHERE user_id = " . $_REQUEST['recordid'];

            $results2 = mysqli_query($conn, $sql);

            if (!$results2) {
              echo "Your SQL: " . $sql . "<br><br>";
              echo "SQL Error: " . mysqli_error($conn);
              exit();
            }

            while ($currentrow = mysqli_fetch_array($results2)) {
              ?>
              <div id="jamie">
                <?php
                $image = $currentrow['image'];
                //                    echo $image;
                //                    echo " <img src=assets/'" . $currentrow['image'] . "'>";
                //                    echo " <img src=assets/camera@2x.png>";
                // echo "<img src=http://shivji.student.uscitp.com/SynthesizeFinal/assets/$image>";
                //                    echo "<img src=http://shivji.student.uscitp.com/SynthesizeFinal/assets/camera@2x.png>";

                ?>

              </div>
              <div class="title">
                <?php
                echo $currentrow['firstname'] . ' ';
                echo $currentrow['lastname'];
                ?>

              </div>

              <br>


              <div class="title">
                <em>
                  <?php
                  echo $currentrow['username'];
                  ?></em></div>

                  <br>

                  <div class="title">

                    <?php
                    echo $currentrow['email'];
                    ?></div>

                    <br>


                    <?php
                  }
                  ?>

                  <!--  SAVED SKETCHES EXPLORED USER-->

                  <?php
                  $conn = mysqli_connect("uscitp.com", "jahaberm", "8787266053", "jahaberm_synthesize");
                  if (mysqli_connect_errno()) {
                    echo "Failed to connect to mySQL: " . mysqli_connect_errno();
                    exit();
                  }
                  ?>

                  <form action="loadSketchProf.php">
                    <!--    <form action="loadSketch.php">-->
                    <div style="margin-left:auto;margin-right:auto;text-align:center">
                      <select class="test" name="sketch" data-cuteform="true">
                        <?php
                        $currentUser = $_SESSION['sessionUserID'];
                        $sql = "SELECT * FROM FavoriteSketches WHERE user_id = " . $_REQUEST['recordid'];
                        $results = mysqli_query($conn, $sql);
                        if (!$results) {
                          echo "Please Log in! :)";

                          exit();
                        }
                        while ($currentrow = mysqli_fetch_array($results)) {
                          $matchingURL = $currentrow['url'];
                          $sketchID = $currentrow['sketch_id'];
                          $thumbnail = getThumbnail($sketchID);
                          $name = getName($sketchID);

                          echo "<option value='" . $name . "' data-cuteform-image='assets/SketchThumbnails/" . $thumbnail . "'></option>";

                        }

                        ?>
                      </select>
                      <div style="margin: 50px 0 50px 0"></div>
                    </div>
                    <center>
                      <input type="hidden" name="inputURL" value="<?php echo $matchingURL; ?>"><br>


                      <div style="margin-bottom:7px;"></div>
                      <input id="submit" type="submit" value="View Visualization">
                    </center>
                  </form>
                  <?php
                }



                ?>

                <?php
                // LATER: FOR SECURITY
                // require_once('db_credentials.php');
                // $conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
                $conn = mysqli_connect("uscitp.com", "jahaberm", "8787266053", "jahaberm_synthesize");
                if (mysqli_connect_errno()) {
                  echo "Failed to connect to mySQL: " . mysqli_connect_errno();
                  exit();
                }
                function getThumbnail($id)
                {
                  // $id should be the ID of the sketch that we are dealing with currently
                  // generate sql to the sketch table to grab the thumbnail

                  $connection = mysqli_connect("uscitp.com", "jahaberm", "8787266053", "jahaberm_synthesize");
                  if (mysqli_connect_errno()) {
                    echo "Failed to connect to mySQL: " . mysqli_connect_errno();
                    exit();
                  }

                  $sql = "SELECT thumbnail FROM Sketches WHERE id_sketch = $id";

                  $results = mysqli_query($connection, $sql);

                  if (!$results) {
                    echo "SQL error " . mysqli_error($connection);
                  }

                  // generate thumbnail from login2
                  $row = mysqli_fetch_array($results);
                  $thumb = $row['thumbnail'];

                  return $thumb;

                }

                function getName($id)
                {

                  $connection = mysqli_connect("uscitp.com", "jahaberm", "8787266053", "jahaberm_synthesize");
                  if (mysqli_connect_errno()) {
                    echo "Failed to connect to mySQL: " . mysqli_connect_errno();
                    exit();
                  }

                  $sql = "SELECT name FROM Sketches WHERE id_sketch = $id";

                  $results = mysqli_query($connection, $sql);

                  if (!$results) {
                    echo "SQL error " . mysqli_error($connection);
                  }

                  // generate thumbnail from login2
                  $row = mysqli_fetch_array($results);
                  $nam = $row['name'];

                  return $nam;

                }

                ?>


              </center>

            </div>


            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0-alpha1/jquery.min.js"></script>
            <script src="scripts/cuteform.min.js"></script

            </body>
            </html>
