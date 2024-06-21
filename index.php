<?php session_start();  ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Login</title>
</head>
<!-- php code star -->
<?php
    require('connection.php');
    $empty_message = "";

    if(isset($_POST['submit'])){
        $email = $_POST['email'];
        $password = md5($_POST['password']);
        
        echo $email . $password;
    
            $select_input_data = "SELECT * FROM user_details WHERE email = '$email' AND password = '$password'";
            $query = $conn -> query($select_input_data);

            if($query -> num_rows > 0){
               
                $user_data = "SELECT * FROM user_details WHERE email = '$email'";
                $user_data_query = $conn -> query($user_data);
                $user_data_array = mysqli_fetch_array($user_data_query);
                $_SESSION['login'] = $user_data_array; 
                header('location:home.php');
            }
            else{
                echo 'not found';

            }
        }
       
    

?>
<!-- php code end -->
<body>
<div class="container flex items-center justify-center mx-auto h-screen">
    <form action="index.php" method ="post" class=" border w-1/2 p-4  rounded bg-slate-100">

 <?php echo isset( $_GET['successful']) ? "<p class='text-xl text-green-500'>" . "Registration successfully" . "</p>" : " "; ?> 

        <h1 class="text-center text-2xl">Please! Login</h1>
        <div class="w-full mt-4">
            <label for="email" class="text-xl">Email</label> <br>
            <input type="email" name="email" class="w-full border border-black mt-2 h-10 rounded p-1 ">
        </div>
        <div class="w-full mt-4">
            <label for="password" class="text-xl"> Password </label> <br>
            <input type="password" name = "password" class="w-full border border-black mt-2 h-10 rounded p-1">
        </div>
        
        <div class="border border-red-500">
        <?php  echo isset($_POST['submit']) ?   "<p class='text-xl text-red-500'>". $empty_message . "</p>"  : ""; ?>
        </div>

        <input type="submit" name = "submit" value ="Login" class="bg-pink-600 cursor-pointer text-white px-10 py-2 rounded text-xl mx-auto block mt-6"  >
        <p class="text-center mt-2 text-x">No account ? <a href="sign_up.php" class="text-green-500"> Register </a></p>
    </form>
    </div>
</body>
</html>