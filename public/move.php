<?php

  

/* Store the path of source file */

$filePath = 'storage/ab.png';

  

/* Store the path of destination file */

$destinationFilePath = 'ab.png';

  

/* Copy File from images to copyImages folder */

if( !rename($filePath, $destinationFilePath) ) {  

    echo "File can't be moved!";  

}  

else {  

    echo "File has been moved!";  

} 

  

?>