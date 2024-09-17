<?php

include "server.php";

session_start();
    $userID = $_SESSION["id"];
    $role=$_SESSION["role"];
    $name=$_SESSION['name'];
    $email=$_SESSION["email"];

$tab = $_GET['tab'];





if (isset($_GET['delete_id']) && !empty($_GET['delete_id'])) {
    
    $deleteId = $_GET['delete_id'];
    $deleteSql = "DELETE FROM books WHERE id = ?";
    $stmt = $conn->prepare($deleteSql);
    $stmt->bind_param("i", $deleteId);
    
    if ($stmt->execute()) {
        header("Location: admin.php");
    } else {
        die("Error deleting record: " . $stmt->error);
    }
}




if ($tab == "booklistadmin") {
    
    $sql = "SELECT * FROM books";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "
        <h4>All Bookes</h4>
        <table border='1'>
                <tr>
                    <th>Title</th>
                    <th>Author</th>
                    <th>ISBN Number</th>
                    <th>Genre</th>
                    <th>Publication Year</th>
                    <th>Price</th>
                    <th>Seller name</th>
                    <th>Seller ID</th>
                   
                    <th>Book Cover</th>
                    <th>Actions</th>
                </tr>";
    
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row["title"] . "</td>
                    <td>" . $row["author"] . "</td>
                    <td>" . $row["isbn"] . "</td>
                    <td>" . $row["genre"] . "</td>
                    <td>" . $row["publication_year"] . "</td>
                    <td>" . $row["price"] . "</td>
                    <td>" . $row["seller_name"] . "</td>
                    <td>" . $row["seller_id"] . "</td>

                    <td><img src='" . $row["book_cover"] . "' alt='Book Cover' width='100'></td>
                    <td>
                        
                        <a href='?delete_id=" . $row["id"] . "' onclick=\"return confirm('Are you sure you want to delete this record?');\">Delete</a>
                    </td>
                </tr>";
        }
        echo "</table>";
    } else {
        echo "No records found";
    }

    


    
} elseif ($tab == "myOrders") {
    
    $query = "SELECT * FROM user_orders WHERE user_id = ?"; 
    
}


$conn->close();
?>
