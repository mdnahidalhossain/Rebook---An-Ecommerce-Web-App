<?php

   include "server.php";


   if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password']; 
    $role = $_POST['usertype'];

    
        if($role=="user"){
            $db = $conn->prepare("INSERT INTO user (name, email, phone, password, role) VALUES (?, ?, ?, ?, ?)");
            $db->bind_param("sssss", $name, $email, $phone, $password, $role);

            if ($db->execute()) {

                session_start();
                $_SESSION["id"]=$db->insert_id;
                $_SESSION["email"]=$email;
                $_SESSION["name"]=$name;
                $_SESSION["role"]=$role;
                echo $_SESSION['id'];
                // header("Location: index.php");
                
            } else {
                echo "Error: " . $db->error;
            }

        $db->close();
        }
        else if($role=="seller"){
            $db = $conn->prepare("INSERT INTO seller (name, email, phone, password, role) VALUES (?, ?, ?, ?, ?)");
            $db->bind_param("sssss", $name, $email, $phone, $password, $role);

            if ($db->execute()) {
                session_start();
                $_SESSION["id"]=$db->insert_id;
                $_SESSION["email"]=$email;
                $_SESSION["name"]=$name;
                $_SESSION["role"]=$role;
                
                header("Location: index.php");
            } else {
                echo "Error: " . $db->error;
            }
            $db->close();
        }
        
    
}

$conn->close();
?>


