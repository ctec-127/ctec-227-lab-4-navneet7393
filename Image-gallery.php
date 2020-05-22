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

    <link rel="stylesheet" type="text/css" href="css/style2.css">

<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="login.php" id="login">Login</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="logout.php" id="logout">Logout</a>
      </li>
    </ul>
  </div>
</nav>

    <img src="./img/imageedit_1_3709156988.png" class="upload-img" alt="upload-img" height="150">
    <h1>Image Gallery</h1>

	<?php 
    $error = "";
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
							UPLOAD_ERR_NO_FILE 			=> "<p class='p-3 mb-2 bg-danger text-white' id='para-width'><strong>No file.<strong></p>",
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
            $message = "<p class='p-3 mb-2 bg-success text-white' id='para-width'><strong>File uploaded successfully<strong></p>";
        } else {
            $error = $_FILES['file_upload']['error'];
            $message = $upload_errors[$error];
    }  
        
    

		// $_FILES[] super global
		// not stored in $_POST[]
		// echo "<pre>";
		// print_r($_FILES['file_upload']);
		// echo "</pre>";
     // end of if
    }

    
    
	?>
    
    
	<?php if(!empty($message)) {echo "<p>{$message}</p>";} ?>
	<form action="" method="post" enctype="multipart/form-data">
        <input type="hidden"  name="MAX_FILE_SIZE" value="100000000">
        <div class="custom-file">
        <input type="file" class="custom-file-input" name="file_upload">
        <label class="custom-file-label"></label>
        <input type="submit" class="btn btn-dark" name="submit" value="Upload">

        </div>
    </form>

    <?php

if (isset($_GET['file'])) {
    //Note: files are deleted permanently. If we want to create a backup:
    // copy('uploads/' . $_GET['file'], 'backup/' . $_GET['file']);

    unlink("uploads/" . $_GET['file']);
    header('Location:image-gallery.php'); //redirection of the page to not show the url
} else {
    echo "";
}
        // displaying the images 
        //start at current directory 
        $dir = "uploads";
        if (is_dir($dir)) {
            if ($dir_handle = opendir($dir)) {
                while ($filename = readdir($dir_handle)) {
                    if(!is_dir($filename)) {
                        $filename = urlencode($filename);
                        echo "<img class='p-2' src=\"uploads/$filename\" alt=\"A photo\" height=\"200\">";
                        echo "<a href=\"image-gallery.php?file=$filename\">Delete</a>";
                    }
                }
                closedir($dir_handle);
            } 
        }


    ?>

</div>
</body>



</html>