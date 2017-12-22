<?php
/*
 * @Author Pushpraj Katiyar
 * @Email: pushprajkatiyar@gmail.com
 * @copyright: 2016
 */
set_time_limit(0);
$row = 1;
if (($handle = fopen("book1.csv", "r")) !== FALSE) {
  while (($data = fgetcsv($handle, 10000, ",")) !== FALSE) {

    $name =  $data[1];
   $desc = addslashes($data[3]);   
   $price = str_replace(" ?", "", $data[4]);   
   $duration = $data[2];   
   $url = $data[5];   
   
   $res = mysqli_connect("localhost", "root", "", "trekoholic");
   echo $query = "insert into tours(name, `desc`, price, region, duration, url, createdAt) Values('$name', '$desc', '$price', 'India', '$duration', '$url', 'UTC_TIMESTAMP()')";
   $result = mysqli_query($res, $query);
   echo $row." >> ".$data[0];
   echo " Affected rows: " . mysqli_affected_rows($res)."<br/> ";
   var_dump($result);
   $row++;
  }
  fclose($handle);
}

?>
