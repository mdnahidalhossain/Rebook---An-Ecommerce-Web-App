<?php
include "server.php";

session_start();
$userID = $_GET["id"];
$role=$_SESSION["role"];


if($role=='user'){
    $db = $conn->prepare("SELECT * FROM user WHERE id = ?");
    $db->bind_param('i', $userID);
    $db->execute();
    $result = $db->get_result();

    if ($result->num_rows == 1) {
        $userData = $result->fetch_assoc(); 
    } else {
        echo "Didn't get data";
        exit; 
    }

}else if($role=='seller'){
    $db = $conn->prepare("SELECT * FROM seller WHERE id = ?");
    $db->bind_param('i', $userID);
    $db->execute();
    $result = $db->get_result();

    if ($result->num_rows == 1) {
        $userData = $result->fetch_assoc(); 
    } else {
        echo "Didn't get data";
        exit; 
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="profile.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    
    <style>
    table {
        margin-top: 1%;
        width: 100%;
        border-collapse: collapse;
        border: 2px solid #0E8388;
    }
    
    th, td {
        border: 1px solid #ccc;
        padding: 10px;
        text-align: left;
        white-space: nowrap;
    }

    th {
        background-color: #007bff;
        color: #fff;
    }

    tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    tr:hover {
        background-color: #ddd;
    }

    img {
        max-width: 100px;
        height: auto;
    }

    .actions {
        text-align: center;
    }

    .actions a {
        margin: 5px;
        padding: 5px 10px;
        text-decoration: none;
        background-color: #007bff;
        color: #fff;
        border-radius: 5px;
        display: inline-block; 
    }

    .actions a:hover {
        background-color: #0056b3;
    }

    
    .ellipsize {
        overflow: hidden;
        text-overflow: ellipsis;
        max-width: 150px;
    }
    .booklist{
        overflow-y:scroll;
        height:500px;
    }


    ::-webkit-scrollbar {
        width: 5px;
    }
    ::-webkit-scrollbar-track {
        background: black;
    }
    ::-webkit-scrollbar-thumb {
        background: white;
    }

    
    @media (max-width: 768px) {
        table {
            font-size: 14px; 
        }

        th, td {
            padding: 8px;
        }

        .actions a {
            padding: 3px 8px;
        }
    }
</style>





</head>
<body>

    <?php include "navbar2.php" ?>

    <section>
        <div class="container">
           <div class="d-flex profile-i">
                <img src="./images/profile.jpg" alt="">
                <div>
                    <p><?php echo $userData["name"]; ?></p>
                    <p><?php echo $userData["email"]; ?></p>
                </div>
           </div>
        </div>
    </section>
    <section class="container user-list">
        <div class="d-flex justify-content-center">
            <div>
                <?php 
                    if($role=='user'){
                        echo "
                            <a href='javascript:void(0);' class='tab-link' data-tab='myOrder'>MY order</a>
                        
                        ";
                    }else if($role=="seller"){
                        echo "
                        <a href='javascript:void(0);' class='tab-link' data-tab='bookList'>Added book list</a>
                        <a href='javascript:void(0);' class='tab-link' data-tab='orderList'>Order list</a>
                        <a href='addbooksSeller.php' class='tab-link' >Add books to sell</a>
                    ";

                    }
                
                
                ?>
                

                <a type="button" class=" btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Edit account
                </a>
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit your account</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        

                    <form action="/updateProfile.php">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Change email address</label>
                            <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp">
                        </div>
                        
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Change Password</label>
                            <input type="password" class="form-control" id="password" name="password">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>





                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                    </div>
                </div>
                </div>

            </div>
        </div>
    </section>



    <section class="container d-flex justify-content-center booklist">
    <div id="content-d">
        
    </div>
    </section>


    <section>
        <?php include "footer.php" ?>
    </section>


    
    

    <script>
        $(document).ready(function() {
            $(".tab-link").click(function() {
                var tabName = $(this).data("tab");
                loadTabContent(tabName);
            });
        });

        function loadTabContent(tabName) {
            $.ajax({
                url: "booklistSeller.php?tab=" + tabName,
                type: "GET",
                success: function(data) {
                    $("#content-d").html(data);
                }
            });
        }
    </script>
</body>
</html>
