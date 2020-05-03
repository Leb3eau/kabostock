<?php

setlocale (LC_TIME, 'fr_FR.utf8','fra');
if (isset($_POST['ok'])) {
  date_default_timezone_set('Africa/Abidjan');
  echo date('H:i:s <em>');
}  		