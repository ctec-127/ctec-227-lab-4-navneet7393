<?php


if (isset($_GET['file'])) {
    unlink("uploads/" . $_GET['file']);
}
        // displaying the images 
        //start at current directory 
        $dir = "uploads";
        if (is_dir($dir)) {
            if ($dir_handle = opendir($dir)) {
                while ($filename = readdir($dir_handle)) {
                    if(!is_dir($filename)) {
                        echo "<img class='p-2' src=\"uploads/$filename\" alt=\"A photo\" height=\"200\">";
                        echo "<a href=\"delete.php?file=$filename\">Delete</a>";
                    }
                }
            } closedir($dir_handle);
        }


    
    ?>