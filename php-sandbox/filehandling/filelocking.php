<?php
	$fp = fopen("testfile.txt",'r+') or die("Failed to open file.");
    $text = fgets($fp);
    
    if (flock($fp, LOCK_EX)) {
        /*The SEEK_END tells the function to move the file pointer to
        the end of the file, and the 0 parameter tells it how many positions it should then be
        moved backwards from that point.*/
        fseek($fp,0,SEEK_END);
        fwrite($fp,$text) or die("Could not write to file");
        flock($fp,LOCK_UN);
    }
    fclose($fp);
    echo "File 'testfile.txt' successfully updated"
?>