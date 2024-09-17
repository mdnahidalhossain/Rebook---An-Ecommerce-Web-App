<?php
include "server.php";

session_start();

$role=$_SESSION["role"];
$userID=$_SESSION["id"];

    if($role=='admin'){
        $db = $conn->prepare("SELECT * FROM admin WHERE id = ?");
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



if (isset($_POST['delete_book'])) {
    $id_to_delete = $_POST['book_id'];
    $sql_delete = "DELETE FROM books WHERE id = $id_to_delete";
    if ($conn->query($sql_delete) === TRUE) {
        echo '<div class="alert alert-success">Book deleted successfully!</div>';
    } else {
        echo '<div class="alert alert-danger">Error deleting book: ' . $conn->error . '</div>';
    }
}


$sql_select = "SELECT * FROM books";
$result = $conn->query($sql_select);


$sql_select = "SELECT * FROM user";
$result2 = $conn->query($sql_select);




$sql_select = "SELECT * FROM seller";
$result3 = $conn->query($sql_select);



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
    .s1,.s2,.s3{
        box-shadow: 0 4px 2px -2px rgba(232, 232, 232, 0.744);
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



    <section class="container d-flex justify-content-center booklist s1">
    <div id="content-d">
    <div class="container mt-5">
        <h2>Book Inventory</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Author</th>
                    <th>ISBN</th>
                    <th>Genre</th>
                    
                    <th>Price</th>
                    <th>Availability</th>
                    <th>Book Cover</th>
                    <th>Seller Name</th>
                    <th>Seller Email</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '<tr>';
                        echo '<td>' . $row['id'] . '</td>';
                        echo '<td>' . $row['title'] . '</td>';
                        echo '<td>' . $row['author'] . '</td>';
                        echo '<td>' . $row['isbn'] . '</td>';
                        echo '<td>' . $row['genre'] . '</td>';
                        echo '<td>' . $row['price'] . '</td>';
                        echo '<td>' . $row['availability'] . '</td>';
                        echo '<td><img src="' . $row['book_cover'] . '" alt="Book Cover" width="100"></td>';
                        echo '<td>' . $row['seller_name'] . '</td>';
                        echo '<td>' . $row['seller_email'] . '</td>';
                        echo '<td>
                                <form method="POST">
                                    <input type="hidden" name="book_id" value="' . $row['id'] . '">
                                    <button type="submit" name="delete_book" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                              </td>';
                        echo '</tr>';
                    }
                } else {
                    echo '<tr><td colspan="13">No books found</td></tr>';
                }
                ?>
            </tbody>
        </table>
    </div>

    </div>
    </section>




<!-- user data -->

<section class="container d-flex justify-content-center booklist s2">
    <div id="content-d">
    <div class="container mt-5">
        <h2>User Data</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Emain</th>
                    <th>Phone</th>
                    
                    <th>Role</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result2->num_rows > 0) {
                    while ($row = $result2->fetch_assoc()) {
                        echo '<tr>';
                        echo '<td>' . $row['id'] . '</td>';
                        echo '<td>' . $row['name'] . '</td>';
                        echo '<td>' . $row['email'] . '</td>';
                        echo '<td>' . $row['phone'] . '</td>';
                        echo '<td>' . $row['role'] . '</td>';
                        echo '<td>
                                <form method="POST">
                                    <input type="hidden" name="book_id" value="' . $row['id'] . '">
                                    <button type="submit" name="delete_book" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                              </td>';
                        echo '</tr>';
                    }
                } else {
                    echo '<tr><td colspan="13">No books found</td></tr>';
                }
                ?>
            </tbody>
        </table>
    </div>

    </div>
    </section>



    <section class="container d-flex justify-content-center booklist s3">
    <div id="content-d">
    <div class="container mt-5">
        <h2>Seller Data</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Emain</th>
                    <th>Phone</th>
                    
                    <th>Role</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result3->num_rows > 0) {
                    while ($row = $result3->fetch_assoc()) {
                        echo '<tr>';
                        echo '<td>' . $row['id'] . '</td>';
                        echo '<td>' . $row['name'] . '</td>';
                        echo '<td>' . $row['email'] . '</td>';
                        echo '<td>' . $row['phone'] . '</td>';
                        echo '<td>' . $row['role'] . '</td>';
                        echo '<td>
                                <form method="POST">
                                    <input type="hidden" name="book_id" value="' . $row['id'] . '">
                                    <button type="submit" name="delete_book" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                              </td>';
                        echo '</tr>';
                    }
                } else {
                    echo '<tr><td colspan="13">No books found</td></tr>';
                }
                ?>
            </tbody>
        </table>
    </div>

    </div>
    </section>




    <section>
        <?php include "footer.php" ?>
    </section>

</body>
</html>
