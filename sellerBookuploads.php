<?php 

include "server.php";


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    session_start();
    $userID = $_GET["id"];
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

    if (move_uploaded_file($_FILES["bookCover"]["tmp_name"], $target_file)) {
        $sql = "INSERT INTO books (title, author, isbn, genre, publication_year, price, description,availability, bookCover,seller_id,seller_name,seller_email)
                VALUES ('$title', '$author', '$isbn', '$genre', '$publicationYear', '$price', '$description','$available','$target_file','$userID','$name','$email')";
        
        if ($conn->query($sql) === TRUE) {
            echo "Record created successfully.";
            echo "<a href='user_profile.php'>Go to profile</a>"
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Sorry, there was an error uploading your file.";
    }

$conn->close();
}
?>
