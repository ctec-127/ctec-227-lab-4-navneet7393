<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>

    <link rel="stylesheet" type="text/css" href="./css/style.css">
</head>

<body>
	<h1>Image Gallery</h1>

	<?php 

	// Error Codes
	// See http://www.php.net/manual/en/features.file-upload.errors.php

	// UPLOAD_ERR_OK			0 No errors
	// UPLOAD_ERR_INI_SIZE  	1 Larger than upload_max_filesize
 	// UPLOAD_ERR_FORM_SIZE 	2 Larger than form MAX_FILE_SIZE
 	// UPLOAD_ERR_PARTIAL 		3 Partial upload
	// UPLOAD_ERR_NO_FILE 		4 No file
	// UPLOAD_ERR_CANT_WRITE    6 Can't write file
	// UPLOAD_ERR_NO_TMP_DIR	7 No temporary directory
	// UPLOAD_ERR_EXTENSION     8 File upload stopped by extension


	// Define these errors in an array
	$upload_errors = array(
							UPLOAD_ERR_OK 				=> "Upload Successful",
							UPLOAD_ERR_INI_SIZE  		=> "Larger than upload_max_filesize.",
							UPLOAD_ERR_FORM_SIZE 		=> "Larger than form MAX_FILE_SIZE.",
							UPLOAD_ERR_PARTIAL 			=> "Partial upload.",
							UPLOAD_ERR_NO_FILE 			=> "No file.",
							UPLOAD_ERR_NO_TMP_DIR 		=> "No temporary directory.",
							UPLOAD_ERR_CANT_WRITE 		=> "Can't write to disk.",
							UPLOAD_ERR_EXTENSION 		=> "File upload stopped by extension.");

	if($_SERVER['REQUEST_METHOD'] == "POST"){

        // We need to move the temp file 
        // What file do we need to move
        $tmp_file = $_FILES['file_upload']['tmp_name'];

        // set target file name
        //basename just gets the file name
        $target_file = basename($_FILES['file_upload']['name']);

        //set upload folder name
        $upload_dir = 'uploads';

        //Moving the file
        //move_uploaded_files returns false if something went wrong
        if (move_uploaded_file($tmp_file, $upload_dir . "/" . $target_file)){
            $message = 'File uploaded successfully';
        }else{
        $error = $_FILES['file_upload']['error'];
        //error that we selected 
        $message = $upload_errors['error'];
    }  
        
    

		// $_FILES[] super global
		// not stored in $_POST[]
		// echo "<pre>";
		// print_r($_FILES['file_upload']);
		// echo "</pre>";
     // end of if
    }

    //start at current directory 
    $dir = "uploads";
    if (is_dir($dir)) {
        if ($dir_handle = opendir($dir)) {
            while ($filename = readdir($dir_handle)) {
                if(!is_dir($filename)) {
                    echo "<img src=\"$filename\" alt=\"A photo\">";
                } else {
                    echo "folder: {$filename}</br>"; 
                }
            }
        } closedir($dir_handle);
    }
    
	?>

	<?php if(!empty($message)) {echo "<p>{$message}</p>";} ?>
	<form action="" method="post" enctype="multipart/form-data">
		<input type="hidden" name="MAX_FILE_SIZE" value="100000000">
		<input type="file" name="file_upload">
		<input type="submit" class="btn btn-dark" name="submit" value="Upload">
	</form>


</body>


</html>