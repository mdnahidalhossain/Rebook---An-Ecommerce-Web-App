<?php 
    include "server.php";
    include "navbar.php";
    session_abort();
    session_start();
    $seller_name=$_SESSION['seller_name'];
    $seller_id=$_SESSION['seller_id'];
    $price=$_SESSION["price"];    
    $isbn=$_SESSION["isbn"];  

    $buyer_id=$_SESSION["id"];
    $buyer_name=$_SESSION["name"];


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $bookTitle = $_POST["book_title"];
    $quantity = $_POST["quantity"];

    
    $sql = "INSERT INTO orders (title, quantity,isbn,price,seller_id,seller_name,buyer_id,buyer_name) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sisiisis", $bookTitle, $quantity,$isbn,$price,$seller_id,$seller_name,$buyer_id,$buyer_name);
    
        
        if ($stmt->execute()) {
            $successMessage = "Order placed successfully!";
        } else {
            echo "Error placing the order: " . $stmt->error;
        }
     $stmt->close();
    
}

?>


<head>
    
    <script>
        
        <?php if (!empty($successMessage)): ?>
            alert("<?php echo $successMessage; ?>");
        <?php endif; ?>
    </script>
</head>

<body>

        
    
</body>
