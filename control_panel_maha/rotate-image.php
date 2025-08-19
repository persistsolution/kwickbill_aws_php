<?php
$imagePath = '../uploads/30aceb944cf496f1c222c22757f9b46f.jpg';
$angleFile = 'angle.txt';

$currentAngle = file_exists($angleFile) ? (int) file_get_contents($angleFile) : 0;
?>

<!DOCTYPE html>
<html>
<head>
    <title>Rotate Image by 90°</title>
</head>
<body>
    <h2>Current Rotation: <?= $currentAngle ?>°</h2>

    <img src="<?= $imagePath . '?v=' . time(); ?>" width="400" />
    <br><br>

    <form action="rotate.php" method="post">
        <button type="submit">Rotate 90°</button>
    </form>
</body>
</html>
