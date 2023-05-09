<?php


use HariharanUmapathi\Unicode\Data\Tamil;
//Data provider function will return array of tamil utf-8 characters 
require_once "../data/Tamil.php";
//Convert tscii has utililty 
//function convert_to_tscii will convert utf-8 characters into tscii characters encoding
require_once "../converter_tscii.include.php";
$tamil_letters = new Tamil();
$text = "";
$string_array = [];
foreach ($tamil_letters->data_provider() as $row) {
    $string_array[] = convert_to_tscii(join("", $row));
}
//Image Writing Part 
//Creating Image with 2000,1000 dimension
$im = @imagecreatetruecolor(2000, 1000)
    or die('Cannot Initialize new GD image stream');
$text_color = imagecolorallocate($im, 233, 14, 91);
//Adding Font from fonts folder
putenv('GDFONTPATH=' . realpath('../fonts'));
//Current TSCII font 
$font = "TSCu_Paranar.ttf";
//Writing Text to the image
$i = 0;
$font = realpath("../fonts/TSCu_Paranar.ttf");
foreach ($string_array as $text) {
    $i++;
    imagettftext($im, 40, 0, 10, $i * 50, $text_color, $font, $text);
}
header('Content-Type: image/png');
imagepng($im);
imagedestroy($im);
return;
