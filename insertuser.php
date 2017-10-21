<html>
<head>
    <title>Synthesize</title>
    <link rel="icon" type="image/png" href="favicon.png">
    <link href="https://fonts.googleapis.com/css?family=Inconsolata" rel="stylesheet">
    <link rel="stylesheet" href="styles/synthesize_home_styles.css">

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


    @font-face {
        font-family: 'Letter Gothic Std';
        src: url(admin/fonts/LetterGothicStd.otf);
    }


    @font-face {
        font-family: 'Letter Gothic Std';
        src: url(admin/fonts/LetterGothicStd.otf);
    }

    body p {font-family: 'Letter Gothic Std';}

    div {
        font-family: 'Letter Gothic Std';
    }


    #masthead img {
        width: 600px;
        margin-top: 370px;
        margin-left: 2%;
    }



    #logIn p {
        width:150px;
        margin-left: 40px;
        font-family: 'Letter Gothic Std';
        color: #82caed;
        font-size: 13pt;
        text-align:center;
        padding-top:4px;
        opacity:0.7;}

    #logIn p:hover {
        width:150px;
        top: 200px;
        margin-left: 40px;
        font-family: 'Letter Gothic Std';
        color: #82caed;
        font-size: 13pt;
        text-align:center;
        padding-top:4px;
        cursor: pointer;
        font-style: italic;
        opacity: 1;
    }

    #logIn a {
        text-decoration: none;
        color:#82caed;
    }



    #credits p {
        width: 130px;
        cursor: pointer;
        position: fixed;
        right: 15;
        bottom: 10px;
        margin: 0;
        padding: 0;
        opacity: .7;
        font-family: 'Letter Gothic Std';

        color: white;
    }

    #about img{
        width:30px;
        position: fixed;
        left: 980px;
        bottom: 15px;
        margin: 0;
        padding: 0;
        opacity: .7;  }

    #about img:hover{
        /*background-image: url('about_x.png');*/
        cursor:pointer;
        width:30px;
        position: fixed;
        left: 980px;
        bottom: 15px;
        margin: 0;
        padding: 0;
        opacity: .7;  }

    #user {width:250px;
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

    #user {
        margin-left:50px;
    }


    #pass {width:250px;
        height: 30px;
        opacity:0.8;
        border: 1px solid #82caed;
        background:none;
        font-family: 'Letter Gothic Std';
        font-size: 12pt;
        padding: 2px;
        color: #82caed;}

    #pass {margin-left:50px;}

    #user {position:relative;
        /*margin-top:200px;*/

    }

    #submit {width: 100px;
        height: 30px;
        border: none;
        background:none;
        font-family: 'Letter Gothic Std';
        font-size: 12pt;
        padding: 2px;
        color: #82caed;
        /*margin-left:930px;*/
        opacity: 0.7;
        margin-left: 60px;}

    #submit:hover {width: 100px;
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
        margin-left: 60px;}

        #header{
          margin-top:10px;
        }
        #canvass{
            overflow: hidden;
            width:100%;
            border:none;
            height:100%;
            position:absolute;
            z-index:-1;
        }
</style>

<body style="   font-family: 'Letter Gothic Std';
             color: #82caed;
			">
      <canvas id="canvass" data-processing-sources="portfoliobg.pde" >

      </canvas>

<center>

    <div id="outercontainer">

        <div id="mainHead">
            <?php

            if(empty($_REQUEST['firstname'])) {
                echo "Sign Up  <a href='signup.php'>here!</a> ";
                exit();
            }

            if(empty(trim($_REQUEST['email']))) {
                echo "Please enter an email.";
                exit();
            }

            // SECURE AFTER
            $connection = mysqli_connect("uscitp.com", "jahaberm", "8787266053", "jahaberm_synthesize");

            if(mysqli_connect_errno()) {
                echo "CONNECTION ERROR:" . mysqli_connect_errno();
                exit();
            }


            $path = $_SERVER["DOCUMENT_ROOT"] . "/SynthesizeFinal/assets/". $_FILES['thefile']['name'];

            move_uploaded_file($_FILES['thefile']['tmp_name'], $path); //(what file you want to move, where do you want to move it to)



            // $newfile = "http://shivji.student.uscitp.com/SynthesizeFinal/assets/";
            $newfile = "http://www.synthesize3d.com/assets/";
            $newfile = $newfile . $_FILES['thefile']['name'];

            $files =  $_FILES['thefile']['name'];
            // echo "<img src='assets/$files'>";



            $sql = "INSERT INTO User " .
                "(firstname, lastname, email, password, username, image) " . "VALUES " .
                "(" .
                "'" .
                $_REQUEST['firstname'] .
                "' ," .
                "'" .
                $_REQUEST['lastname'] .
                "' ," .
                "'" .
                $_REQUEST['email'] .
                "' ," .
                "'" .
                $_REQUEST['password'] .
                "' ," .
                "'" .
                $_REQUEST['username'] .
                "' ," .
                "'" .
                $files .
                "'" .
                ")";

            $results = mysqli_query($connection, $sql);

            if(!$results) {
                echo "FORM info " . print_r($_REQUEST) . "<hr>";
                echo "SQL: " . $sql . "<hr>";
                echo "ERROR: " . mysqli_error($connection);
                exit();
            } else {
//hi
                ?>
                <center>
                  <canvas id="canvass" data-processing-sources="portfoliobg.pde" >

                  </canvas>
                    <div id="outercontainer" style=" top:-100px;position:absolute; position: absolute; height:10px;
                margin-left: auto;
                margin-right: auto;
                left: 0;
                right: 0;
                ">
                        <div id="mainHead" style=" height:10px;">
                            <div id="masthead" >
                                <img id="logo" src="assets/home/main_logo.png"/>
                            </div>
                            <?php
                            echo "<div id='header'>" .
                                "Thank you so much for signing up, " . $_REQUEST['firstname'] . "!" . "</div>";
                        }

                        ?>
                        <div id="login">
                            <p><a href="login2.php">login<a/></p>
                        </div>


                </center>


        </div>



        <div id="credits">
            <p>Created by <strong><span style="width: 170px;">synthesizegeek</span></strong></p>

        </div>


    </div>

</center>

</body>
</head>
</html>
