<?php
	/*
    How to handle files
    */
    
    //get a file resource
    $fp = fopen('newfile.txt','a+') or die("Cannot create the file");
    //echo "fopen() is a object? ".is_object($fp);
    if(is_object($fp)) {
        echo "fopen() returns a object.<br/>";
    }
    else echo gettype($fp);
    
    fwrite($fp,"\nThis is line");
    fwrite($fp,"\nThis is line2");
    
    /*The SEEK_SET option tells the function to set the file pointer to the exact position specified.*/
    fseek($fp,0,SEEK_SET);
    
    while($content=fgets($fp)) {
        echo "<br/>".$content;
    }
    
    fclose($fp);
    
    echo("<br/><pre>".file_get_contents("newfile.txt")."</pre>");
    
?>