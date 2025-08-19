<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
$imagePath = '../uploads/30aceb944cf496f1c222c22757f9b46f.jpg';
$angleFile = 'angle.txt';

// Step 1: Detect MIME type
$mime = mime_content_type($imagePath);

// Step 2: Load image based on type
switch ($mime) {
    case 'image/jpeg':
        $source = imagecreatefromjpeg($imagePath);
        break;
    case 'image/png':
        $source = imagecreatefrompng($imagePath);
        break;
    case 'image/webp':
        $source = imagecreatefromwebp($imagePath);
        break;
    default:
        die("Unsupported image type: $mime");
}

// Step 3: Read current angle
$currentAngle = file_exists($angleFile) ? (int) file_get_contents($angleFile) : 0;
$currentAngle = ($currentAngle + 90) % 360;

// Step 4: Rotate image
$rotated = imagerotate($source, 90, 0);

// Step 5: Save rotated image
switch ($mime) {
    case 'image/jpeg':
        imagejpeg($rotated, $imagePath, 90);
        break;
    case 'image/png':
        imagepng($rotated, $imagePath);
        break;
    case 'image/webp':
        imagewebp($rotated, $imagePath);
        break;
}

// Step 6: Save new angle
file_put_contents($angleFile, $currentAngle);

// Step 7: Clean up
imagedestroy($source);
imagedestroy($rotated);

// Step 8: Redirect back
header("Location: rotate-image.php");
exit;
