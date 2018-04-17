<?php
include('./classes/DB.php');
include('./classes/Login.php');
include('./classes/Image.php');
if (Login::isLoggedIn()) {
    $userid = Login::isLoggedIn();
} else {
    die('Not logged in!');
}

if (isset($_POST['uploadimg'])) {
    //Image::uploadImage('image', "UPDATE users SET profileimg = :image WHERE id=:userid", array(':userid'=>$userid));
    $file = $_FILES['image'];
    print_r($_FILES);
    //var_dump($file);

    $fileName = $_FILES['image']['name'];
    $fileTmpame = $_FILES['image']['tmp_name'];
    $fileSize = $_FILES['image']['size'];
    $fileError = $_FILES['image']['error'];
    $fileType = $_FILES['image']['type'];

    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));
    $allowed = array('jpg', 'jpeg', 'png');

    if (in_array($fileActualExt, $allowed)) {
        if ($fileError === 0) {
            if ($fileSize < 10240000) {
                $fileNameNew = uniqid('', true).".".$fileActualExt;
                $fileDestination = 'uploads/'.$fileNameNew;
                move_uploaded_file($fileTmpame, $fileDestination);
                //header("Location: index.php?uploadsuccess");
            }else {
                echo "Your file is too big!";
            }
        } else {
            echo "There was an error uploading yoour file!";
        }
    } else {
        echo "You cannot upload files of this type!";
    }


}
?>
<h1>My Account</h1>
<form action="my-account.php" method="post" enctype="multipart/form-data">
    Upload an image:
    <input type="file" name="image[]">
    <input type="file" name="image[]">
    <input type="file" name="image[]">
    <input type="submit" name="uploadimg" value="Upload Image">
</form>
