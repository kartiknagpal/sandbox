<?php
	$fp = fopen("testfile.txt",'r+') or die("Failed to open file.");
    $text = fgets($fp);
    
    if (flock($fp, LOCK_EX)) {
        fseek($fp,0,SEEK_END);
        fwrite($fp,$text) or die("Could not write to file");
        flock($fp,LOCK_UN);
    }
    fclose($fp);
    echo "File 'testfile.txt' successfully updated"
?>