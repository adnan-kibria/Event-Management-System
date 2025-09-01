<?php
    include "festivio-db.php";

    $name = "Golam Kibria";
    $username = "admin";
    $email = "adnan@gmail.com";
    $phone_number = "01700000000";
    $gender = "Male";
    $dob = "2000-12-01";
    $nid_number = "1234567890123";
    $address = "Dhaka, Bangladesh";
    $password = "admin123";
    $role = "admin";

    $hash_pass = password_hash($password, PASSWORD_DEFAULT);
    $sql = "INSERT INTO admin (name, username, email, phone_number, gender, dob, nid_number, address, password, role) VALUES ('$name', '$username', '$email', '$phone_number', '$gender', '$dob', '$nid_number', '$address', '$hash_pass', '$role')";
    if($conn->query($sql) === TRUE){
        echo "New record created successfully";
    }
    else{
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
?>