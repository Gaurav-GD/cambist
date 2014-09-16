<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$con=mysqli_connect("localhost","clickoo2_cambist","[(prUKb2I6Vu","clickoo2_cambist");

// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
else{
    echo 'Successfully connected to mysql !!';
}
mysqli_close($con);