<?php
    header("content-type: text/xml");
    echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
?>
<Response>
    <Say>Please speak the name of the language you would like translated, followed by the pound key </Say>
    <Record maxLength="5" action="recorded.php" />
</Response>







