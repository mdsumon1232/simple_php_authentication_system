<?php   session_start(); ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>home</title>


</head>
<body>
    <h1>this is home page </h1>
    
    <?php  

     echo isset($_GET['log_out']) ? "<p>" . "log out successful" . "</p>" : "";

      if (isset($_SESSION['login'])) {
        echo "<div>";
        echo "<p>" . $_SESSION['login']['full_name'] . "</p>";
        echo "<p>" . $_SESSION['login']['email'] . "</p>";
        echo "</div>";
    }
    
     else{
        echo "<br>";
     }
           
        echo  isset($_SESSION['login']) ? "<a href='sign_out.php'>". "Sign Out". "</a>" : ""; 
    ?>

</body>
</html>