<?php

    require 'crud.php';
    

    
    $email = $_POST['email'];
    $oldPassword = $_POST['old_password'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];

    $gg = new Crud();

    $table_name = "login";
    $records = [
    
        "email" => $email,
        "password" => $password
    ];

    if( $password == $confirmPassword){
        $gg->changePassword($table_name, $records, $oldPassword, $password);
        
    }else{
        echo "password do not match!";
    }
    
    
    