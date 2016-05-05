<?php
/* Create the object */
$image = new Imagick('images/Ok-icon.png');

/* Set the opacity */
$image->setImageOpacity(0.1);

/* output the image */
//header('Content-type: image/png');
//$image->getFilename();
//echo "prueba";
//instead
header('Content-type: image/png');
$image->setImageFormat ("png");
$image->setImageOpacity(0.1);

//echo $image;

//phpinfo();
$fileDst="images/test_1.png";
if($f=fopen($fileDst, "w")){ 
  $image->writeImageFile($f);
}

//echo $image;

?>