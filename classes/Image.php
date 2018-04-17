<?php

class Image {

    public static function uploadImage($formname, $query, $params) {
        $file = $_FILES[$formname];
        //print_r($file);

        $fileName = $_FILES[$formname]['name'];
        $fileTmpame = $_FILES[$formname]['tmp_name'];
        $fileSize = $_FILES[$formname]['size'];
        $fileError = $_FILES[$formname]['error'];
        $fileType = $_FILES[$formname]['type'];

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

        $preparams = array($formname=>$fileDestination);

        $params = $preparams + $params;

        DB::query($query, $params);

    }

}
?>
