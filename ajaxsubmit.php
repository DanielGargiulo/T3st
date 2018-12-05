<?php

$connection = mysqli_connect("localhost", "root", "", "test"); // Establishing Connection with Server..
//Fetching Values from URL
$name2 = $_POST['name1'];
$email2 = $_POST['email1'];
$password2 = $_POST['password1'];
$contact2 = $_POST['contact1'];
//Insert query
$query = mysqli_query($connection, "insert into form_element(name, email, password, contact) values ('$name2', '$email2', '$password2','$contact2')");
echo "Form Submitted Succesfully";
mysqli_close($connection); // Connection Closed
?>