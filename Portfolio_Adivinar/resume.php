<?php

$file = $_GET['file'].".pdf";
header("content-disposition:attactment; filename=".urlencode($file));

?>