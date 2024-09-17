<?php 

include "server.php";


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    session_start();
    $userID = $_SESSION["id"];
    $role=$_SESSION["role"];
    $name=$_SESSION['name'];
    $email=$_SESSION["email"];

    $title = $_POST["title"];
    $author = $_POST["author"];
    $isbn = $_POST["isbn"];
    $genre = $_POST["genre"];
    $publicationYear = $_POST["publicationYear"];
    $price = $_POST["price"];
    $description = $_POST["description"];
    $available = $_POST["available"];

    
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["bookcover"]["name"]);

    if (move_uploaded_file($_FILES["bookcover"]["tmp_name"], $target_file)) {
        $sql = "INSERT INTO books (title, author, isbn, genre, publication_year, price, description,availability, book_Cover,seller_id,seller_name,seller_email)
                VALUES ('$title', '$author', '$isbn', '$genre', '$publicationYear', '$price', '$description','$available','$target_file','$userID','$name','$email')";
        
        if ($conn->query($sql) === TRUE) {
            echo "Record created successfully.";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Sorry, there was an error uploading your file.";
    }

$conn->close();
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Information Form</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        
        .form-container {
            max-width: 500px;
            margin: 0 auto;
            padding:1%;
            border: 1px solid #0E8388;
        }
        .form-container h2{
            background: #0E8388;
            color:white;
            padding:1%;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-label {
            font-weight: bold;
        }
        .submit-button {
            background-color: #0E8388;
            color: #fff;
            border: none;
        }
    </style>
</head>
<body>
<section>
<div class="container mt-5 form-container">
    <h2 class="text-center">Book Information Form</h2>
    <form action="addbooksSeller.php"  method="POST" enctype="multipart/form-data" >
        <div class="form-group">
            <label for="title" class="form-label">Title:</label>
            <input type="text" class="form-control" id="title" name="title">
        </div>
        <div class="form-group">
            <label for="author" class="form-label">Author:</label>
            <input type="text" class="form-control" id="author" name="author">
        </div>
        <div class="form-group">
            <label for="isbn" class="form-label">ISBN Number:</label>
            <input type="text" class="form-control" id="isbn" name="isbn">
        </div>
        <div class="form-group">
            <label for="genre" class="form-label">Genre:</label>
            <input type="text" class="form-control" id="genre" name="genre">
        </div>
        <div class="form-group">
            <label for="publicationYear" class="form-label">Publication Year:</label>
            <input type="text" class="form-control" id="publicationYear" name="publicationYear">
        </div>
        <div class="form-group">
            <label for="price" class="form-label">Price:</label>
            <input type="text" class="form-control" id="price" name="price">
        </div>
        <div class="form-group">
            <label for="description" class="form-label">Description:</label>
            <textarea class="form-control" id="description" name="description" rows="4"></textarea>
        </div>
        <div class="form-group">
            <label for="yesNoSelect">Select Yes or No:</label>
                <select class="form-control" id="available" name="available">
                    <option value="yes">Yes</option>
                    <option value="no">No</option>
                </select>
        </div>
        <div class="form-group">
            <div class="input-group mb-3">
                <label class="input-group-text" for="bookcover">Upload</label>
                <input type="file" id="bookcover" name="bookcover"class="form-control">
            </div>
        </div>
        <div class="text-center">
            <button type="submit" class="btn submit-button">Uploads</button>
        </div>
    </form>
</div>
</section>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

