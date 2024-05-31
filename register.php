<?php

// Retrieve the form data
$username = $_POST['username'];
$password = $_POST['password'];

// Register the user
if (register_user($username, $password)) {
    header("Location: index.html");
} else {
    header("Location: register.html?error=1");
}
exit();

function register_user($username, $password) {
    // Add code to register the user
    return true; // or false based on registration result
}
?>
