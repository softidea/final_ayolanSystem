<?php
$tomorrow  = mktime(0, 0, 0, date("m")  , date("d")+1, date("Y"));
$lastmonth = mktime(0, 0, 0, date("m")-1, date("d"),   date("Y"));
$nextyear  = mktime(0, 0, 0, date("m"),   date("d"),   date("Y")+1);
?>

<?php
$date=date_create("2013-03-15");
//echo date_format($date,"Y/m/d H:i:s");
echo date_format($date,"Y/m/d");
?>