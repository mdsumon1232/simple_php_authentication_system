<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Login</title>
</head>
<!-- php code start -->
    <?php

   require('connection.php');
   
   $error_message = "";

    if(isset($_POST['submit'])){
        $full_name = $_POST['full_name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];
        $hash_password = md5($password);
     
        if(empty($full_name) && empty($email) && empty($password) && empty($confirm_password)){
            $error_message = 'Fill all the flied';
        }
        else{
            if($password === $confirm_password){
                $email_exits = "SELECT * FROM user_details WHERE email = '$email'";
                $email_exits_query = $conn -> query($email_exits);
                if($email_exits_query->num_rows >0){
                  $error_message = "email already exits";
                }
                else{
                   $insert_data = "INSERT INTO user_details (full_name , email , password) 
                                  VALUES ('$full_name' , '$email' , '$hash_password' )";
                  
                  if($conn -> query($insert_data) == TRUE){
                      header('location:index.php?successful');
                  }
                  else{
                      echo "something wrong";
                  }
                }
              }
              else{
                  echo "password does not match";
              }
        }
    }

    ?>
<!-- php code end -->
<body>
    <div class="container flex items-center justify-center mx-auto h-screen">
    <form action="sign_up.php" method ="post" class=" border w-1/2 p-4  rounded bg-slate-100">
        <h1 class="text-center text-2xl">Registration</h1>
        <div class="w-full mt-4">
            <label for="full_name" class="text-xl">Full Name</label> <br>
            <input type="text" name ="full_name" class="w-full border border-black mt-2 h-10 rounded p-1">
        </div>
        <div class="w-full mt-4">
            <label for="email" class="text-xl">Email</label> <br>
            <input type="email" name="email" class="w-full border border-black mt-2 h-10 rounded p-1 ">
        </div>
        <div class="w-full mt-4">
            <label for="password" class="text-xl"> Password </label> <br>
            <input type="password" name = "password" class="w-full border border-black mt-2 h-10 rounded p-1">
        </div>
        <div class="w-full mt-4">
            <label for="confirm_password" class="text-xl"> Confirm Password </label> <br>
            <input type="password" name = "confirm_password" class="w-full border border-black mt-2 h-10 rounded p-1">
        </div>
        <div class=" mt-5 p-3">
            <?php  echo isset($_POST['submit']) ? "<p class ='text-xl text-red-500'>" . $error_message . "</p>" : ""  ?>
        </div>
        <input type="submit" name = "submit" value ="register" class="bg-pink-600 cursor-pointer text-white px-10 py-2 rounded text-xl mx-auto block mt-6"  >
        <p class="text-center mt-2 text-x">Have an account ? <a href="index.php" class="text-green-500"> Login </a></p>
    </form>
    </div>

</body>
</html>