<?php 
if($_REQUEST){
require "connection.php";
$errorMsg = "";
$error = 0;

$file = $_FILES['iamge']['tmp_name'];


if(!empty($file)){
    $fileName = pathinfo($_FILES['iamge']['name']);
    $fileExtension = $fileName['extension'];
    $fileSize = $_FILES['iamge']['size'];
    $ss = time() * $fileSize;
    $newFileName = $fileName['filename'] . '_' . $fileSize . '_' .time() ."_" . $ss . '.' . $fileExtension;
    $LocationImage = "imagesUsers/" . $newFileName;
    if($fileSize > 2000000){
        $errorMsg = "File is Over 2 Mb in size <br>";
        $error = 1; 
    }

    $allowedExtension = array('jpeg','png','jpg','jfif');
     
    if(!in_array( $fileExtension,$allowedExtension)){
        $errorMsg = "File type is not allowed  'jpeg','png','jpg','jfif' <br>";
        $error = 1; 
    }

    
    $fullname = $_REQUEST['fullname'];
    $email = $_REQUEST['email'];
    $hash_pass = $_REQUEST['password'];
    $hash = password_hash($hash_pass,PASSWORD_DEFAULT); 
    $password = $hash;
    $image = $newFileName ;

    $data = [
      "fullname" => $fullname,
      "email" => $email,
      "password" => $password,
      "image" => $image
    ];

   
    if($error != 1){
        $sql = "INSERT INTO users (fullname,email,password,image) VALUES (:fullname, :email, :password, :image)";
        move_uploaded_file( $_FILES['iamge']['tmp_name'], $LocationImage );
        $pdo->prepare($sql)->execute($data);
        header("Location: index1.php");
    }

    
} 
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="styles/style.css" rel="stylesheet">

</head>

<body>
    <div class="container">
        <?php if(isset($errorMsg)) { ?>
        <div class="alert alert-danger" role="alert">
            <?php echo $errorMsg ;?>
        </div>
        <?php } ?>
        <h1> Register </h1>
        <form method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="fullname">Full Name</label>
                <input type="text" class="form-control" id="fullname" name="fullname" required>
            </div>
            <div class="form-group">
                <label for="email">E-Mail</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div>
                <label for="formFile" class="form-label">Image</label>
                <input class="form-control" type="file" id="formFile" name="iamge">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="confirm-password">confirm-password</label>
                <input type="password" class="form-control" id="confirm-password" name="confirm-password" required>
            </div>
            <input class="btn  l-btn" type="submit" value="Submit">
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/5.0.0-beta3/js/bootstrap.bundle.min.js"></script>
</body>

</html>