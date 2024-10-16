
<?php
session_start();

if($_REQUEST){
    require "connection.php";

    $email = $_REQUEST['email'];
    $password = $_REQUEST['password'];


    if($email != "" && $password != ""){
        $sql = "SELECT * FROM `users` WHERE `email` ="."'".$email."'";
        $stmt = $pdo->prepare($sql); 
        $stmt -> execute();
        $user = $stmt -> fetch(PDO::FETCH_ASSOC);
        $validpassword = password_verify($password,$user['password']) ;
        If($validpassword === false){
            $errorMsg = "Password is invalid .";
        }else{
            $_SESSION['user'] = $email;
            header("Location: profile.php");
        }

    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Login </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="styles/style.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1 class="text-right">Login</h1>
        <?php if(isset($errorMsg)) { ?>
        <div class="alert alert-danger" role="alert">
            <?php echo $errorMsg ;?>
        </div>
        <?php } ?>
        <form>
            <div class="form-group">
                <label for="email">E-Mail</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn l-btn">Login</button>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/5.0.0-beta3/js/bootstrap.bundle.min.js"></script>
</body>
</html>



