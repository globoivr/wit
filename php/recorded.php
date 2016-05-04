<?php

require_once("api.php");
    echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
    header("content-type: text/xml");

$file = fopen('/tmp/test.wav', 'w');

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,$_REQUEST['RecordingUrl']);
curl_setopt($ch, CURLOPT_FAILONERROR, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_FILE, $file);
curl_exec($ch);
curl_close($ch);
fclose($file);

$LANGUAGE = determineLanguage();


error_log("Found $LANGUAGE");




?>
<Response>
    <Say>Thanks, I am now taking you to a <?php echo $LANGUAGE?> translator </Say>
</Response>
