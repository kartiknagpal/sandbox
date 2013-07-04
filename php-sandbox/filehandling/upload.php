<?php

echo <<< _END
    
<!DOCTYPE html>

<html>
<head>
    <title>Upload a photo</title>
</head>

<body>
    <form method="post" action="upload.php" enctype="multipart/form-data">
        Select File: <input type="file" name="mypic" size="10" value="Upload" />
        <input type="submit" value="Upload photo"/>
    </form>
_END;

if ($_FILES)
{
    $name = $_FILES['mypic']['name'];
    $name = strtolower(preg_replace("/[^A-Za-z0-9.]/", "", $name));
    switch ($_FILES['mypic']['type'])
    {
        case 'image/jpeg':
            $ext = 'jpg';
            break;
        case 'image/gif':
            $ext = 'gif';
            break;
        case 'image/png':
            $ext = 'png';
            break;
        case 'image/tiff':
            $ext = 'tif';
            break;
        default:
            $ext = '';
            break;
    }
    if ($ext)
    {
        //generating filename_timestamp.ext name
        $pos = strrpos($name,'.');
        $n = '';
        for ($i=0;$i<$pos;++$i) {
            $n .= $name[$i];
        }
        $n .= (string)time().".".$ext;
        
        move_uploaded_file($_FILES['mypic']['tmp_name'], $n);
        echo "Uploaded image '$name' as '$n':<br />";
        echo "<img src='$n' />";
    } else
        echo "'$name' is not an accepted image file";
} else
    echo "No image has been uploaded";

?>
</body>
</html>