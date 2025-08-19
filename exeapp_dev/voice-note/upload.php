<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['audioData'])) {
    $data = $_POST['audioData'];

    $filteredData = explode(',', $data);
    $audioBase64 = end($filteredData);
    $audioData = base64_decode($audioBase64);

    $filename = 'voice_' . time() . '.webm';
    $filePath = __DIR__ . '/uploads/' . $filename;

    if (!file_exists(__DIR__ . '/uploads')) {
        mkdir(__DIR__ . '/uploads', 0777, true);
    }

    file_put_contents($filePath, $audioData);
    echo "Audio uploaded as $filename";
} else {
    echo "Invalid request.";
}
?>
