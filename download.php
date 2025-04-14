<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('log_errors', 1);
ini_set('error_log', 'C:\\xampp\\htdocs\\youtube_mp3\\php_errors.log');
$BASE_DIR = 'C:\\xampp\\htdocs\\youtube_mp3\\';
$OUTPUT_DIR = $BASE_DIR . 'output\\';
$TEMP_DIR = $BASE_DIR . 'temp\\';
foreach ([$BASE_DIR, $OUTPUT_DIR, $TEMP_DIR] as $dir) {
    if (!file_exists($dir)) {
        mkdir($dir, 0777, true);
    }
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $videoUrl = $_POST['video_url'];
        $filename = round(microtime(true) * 1000) . '.mp3';
        $outputFile = $OUTPUT_DIR . $filename;
        $pythonScript = $BASE_DIR . 'youtube_mp3.py';
        $command = sprintf(
            'python "%s" "%s" "%s" 2>&1',
            $pythonScript,
            escapeshellarg($videoUrl),
            escapeshellarg($filename)
        );
        exec($command, $output, $returnCode);
        if ($returnCode !== 0 || !file_exists($outputFile)) {
            throw new Exception("Python error (code $returnCode): " . implode("\n", $output));
        }
        header('Content-Type: audio/mpeg');
        header('Content-Disposition: attachment; filename="' . basename($outputFile) . '"');
        readfile($outputFile);
        unlink($outputFile);
        exit;
    } catch (Exception $e) {
        error_log("PHP Error: " . $e->getMessage());
        http_response_code(500);
    }
}