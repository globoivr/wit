function determineLanguage($verbose = false ) {

        $boundry = "Connection: keep-alive";
      $message=shell_exec("/var/www/twil/wit.sh 2>&1");
      $pos = strpos($message,$boundry);
      $message = substr($message, ($pos+ strlen($boundry)));
      $json = json_decode($message);
if ($verbose ) {
      echo "<pre>";
      print_r($json);
}

      if ( count($json->outcomes ) )
      {
        $outcome = $json->outcomes[0];
        $DETERMINED_LANGUAGE = $outcome->_text;
        if ( count ($outcome->entities->LANGUAGE )) {
           $DETERMINED_LANGUAGE = $outcome->entities->LANGUAGE[0]->value;
        }

      }

      return $DETERMINED_LANGUAGE;
}



?>
