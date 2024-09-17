<?php
 include "server.php";

 include "navbar.php";
if (isset($_GET["title"])) {
    $title = $_GET["title"];

    
    $sql = "SELECT title, author, price, book_cover FROM books WHERE title = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $title);
    if ($stmt->execute()) {
        
        $stmt->bind_result($fetchedTitle, $fetchedAuthor, $fetchedPrice, $fetchedCover);

        if ($stmt->fetch()) {
            // Display book details
            echo '<!DOCTYPE html>
                <html lang="en">
                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>Book Details</title>
                    <!-- Include Bootstrap CSS -->
                    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
                </head>
                <body>
                    <div class="container mt-5">
                        <div class="row">
                            <div class="col-md-4">
                                <img src="' . $fetchedCover . '" class="img-fluid" alt="' . $fetchedTitle . ' Cover">
                            </div>
                            <div class="col-md-8">
                                <h2>' . $fetchedTitle . '</h2>
                                <p>Author: ' . $fetchedAuthor . '</p>
                                <p>Price: $' . number_format($fetchedPrice, 2) . '</p>
                                <!-- Add a form here for placing orders -->
                                <form method="post" action="order.php">
                                    <input type="hidden" name="book_title" value="' . $fetchedTitle . '">
                                    <label for="quantity">Quantity:</label>
                                    <input type="number" name="quantity" id="quantity" required>
                                    <button type="submit" class="btn btn-primary">Place Order</button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Include necessary JavaScript and Bootstrap JS here -->
                </body>
                </html>';
        } else {
            echo "Book not found.";
        }

        $stmt->close();
    }
} else {
    echo "Invalid book title.";
}
?>
