<?php
// users
$users = [
    [
        "username" => "user1",
        "password" => password_hash("password1", PASSWORD_DEFAULT),
        "role" => "user"
    ],
    [
        "username" => "admin1",
        "password" => password_hash("password1", PASSWORD_DEFAULT),
        "role" => "admin"
    ],
    [
        "username" => "staff1",
        "password" => password_hash("password1", PASSWORD_DEFAULT),
        "role" => "staff"
    ]
];
?>