<?php

$conn = mysqli_connect("localhost","root","");

if(!$conn){
die("Connection failed");
}

$result = mysqli_query($conn,"SHOW DATABASES");

while($row = mysqli_fetch_row($result)){
echo $row[0]."<br>";
}

?>