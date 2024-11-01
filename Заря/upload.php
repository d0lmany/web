<?php
if (isset($_FILES["picture"]) && is_uploaded_file($_FILES["picture"]['tmp_name'])) {
    $url = 'https://api.qrserver.com/v1/read-qr-code/';
    $picture = $_FILES["picture"];
    $dir = "temp/";

    if (!is_dir($dir)) {
        mkdir($dir);
    }

    $path = $dir . $picture["name"];
    move_uploaded_file($picture["tmp_name"], $path);

    $post = ["file" => new CURLFile(realpath($path))];
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);
    curl_close($ch);
    if ($response === false) {
        echo json_encode(['success' => false, 'message' => 'Ошибка при обращении к API.']);
        unlink($path); // Очистка
        exit;
    }

    $result = json_decode($response, true);
    if (isset($result[0]['symbol'][0]['data'])) {
        $qrData = $result[0]['symbol'][0]['data'];
        echo json_encode(['success' => true, 'id' => $qrData]);
    } else {
        echo json_encode(['success' => false, 'message' => 'QR-код не распознан.']);
    }
    unlink($path);
} else {
    echo json_encode(['success' => false, 'message' => 'Неверный запрос.']);
}
?>
