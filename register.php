<?php

    require 'crud.php';
    

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $gg = new Crud();

    $table_name = "login";
    $records = [
        "name" => $name,
        "email" => $email,
        "password" => $password
    ];

    $gg->insert($table_name, $records);