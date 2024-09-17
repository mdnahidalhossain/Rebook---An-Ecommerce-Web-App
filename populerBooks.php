



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Store</title>
    
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
  .pop-book{
    overflow-y:scroll;  
    height:700px;
  
  }

  .form-input{
            display:flex;
            justify-content:center;
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
</style>
</head>
<body>
    <div class="form-input container">
        <form method="post">
            <div class="row d-flex justify-content-center mt-5">
                <div class="col-md-3">
                    <input type="text" class="form-control custom-input mb-3 w-100" placeholder="Title" name="title">
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control custom-input mb-3 w-100" placeholder="Author" name="author">
                </div>
                <div class="col-md-3">
                    <select class="form-select mb-3" name="genre">
                        <option value="">Select Genre</option>
                        <option value="book1">Book 1</option>
                        <option value="book2">Book 2</option>
                        <option value="book3">Book 3</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-primary w-80">Find Book</button>
                </div>
            </div>
        </form>
    </div>

    <div class="container mt-5 pop-book">
      <div class="row row-cols-md-2">
        <?php
        
        include "server.php";
       
        $title = '';
        $author = '';
        $genre = '';

        
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $title = $_POST["title"];
            $author = $_POST["author"];
            $genre = $_POST["genre"];

            
            $sql = "SELECT title, author, price, book_cover FROM books WHERE 1";

            if (!empty($title)) {
                $title = "%" . $title . "%";
                $sql .= " AND title LIKE ?";
            }

            if (!empty($author)) {
                $author = "%" . $author . "%";
                $sql .= " AND author LIKE ?";
            }

            if (!empty($genre)) {
                $sql .= " AND genre = ?";
            }

            
            $stmt = $conn->prepare($sql);
            if ($stmt) {
                if (!empty($title) && !empty($author) && !empty($genre)) {
                    $stmt->bind_param("sss", $title, $author, $genre);
                } elseif (!empty($title) && !empty($author)) {
                    $stmt->bind_param("ss", $title, $author);
                } elseif (!empty($title) && !empty($genre)) {
                    $stmt->bind_param("ss", $title, $genre);
                } elseif (!empty($author) && !empty($genre)) {
                    $stmt->bind_param("ss", $author, $genre);
                } elseif (!empty($title)) {
                    $stmt->bind_param("s", $title);
                } elseif (!empty($author)) {
                    $stmt->bind_param("s", $author);
                } elseif (!empty($genre)) {
                    $stmt->bind_param("s", $genre);
                }
                $stmt->execute();
                $stmt->bind_result($fetchedTitle, $fetchedAuthor, $fetchedPrice, $fetchedCover);

                while ($stmt->fetch()) {
                  echo '
                  <div class=" col mb-4 col-md-6">
                      <div class="card mb-3">
                          <div class="row g-0">
                              <div class="col-md-4">
                                  <img src="' . $fetchedCover . '" class="card-img" alt="' . $fetchedTitle . ' Cover">
                              </div>
                              <div class="col-md-8">
                                  <div class="card-body">
                                      <h5 class="card-title">' . $fetchedTitle . '</h5>
                                      <p class="card-text">Author: ' . $fetchedAuthor . '</p>
                                      <p class="card-text">Price: $' . number_format($fetchedPrice, 2) . '</p>
                                      <a href="book_details.php?title=' . urlencode($fetchedTitle) . '" class="btn btn-primary">Buy Now</a>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>';
                }

                $stmt->close();
            }
        } else {
            
            $sql = "SELECT * FROM books";
            $result = $conn->query($sql);

            
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {

                    
                    $_SESSION["seller_name"]=$row['seller_name'];
                    $_SESSION["seller_id"]=$row['seller_id'];
                    $_SESSION["price"]=$row["price"];
                    $_SESSION["isbn"]=$row["isbn"];

                  echo '
                  <div class="col mb-4 col-md-6">
                      <div class="card mb-3">
                          <div class="row g-0">
                              <div class="col-md-4">
                                  <img src="' . $row['book_cover'] . '" class="card-img" alt="' . $row['title'] . ' Cover">
                              </div>
                              <div class="col-md-8">
                                  <div class="card-body">
                                      <h5 class="card-title">' . $row['title'] . '</h5>
                                      <p class="card-text">Author: ' . $row['author'] . '</p>
                                      <p class="card-text">Price: $' . number_format($row['price'], 2) . '</p>
                                      <a href="book_details.php?title=' . urlencode($row['title']) . '" class="btn btn-primary">Buy Now</a>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>';
                }
            } else {
                echo "No books available.";
            }
        }

       
        $conn->close();
        ?>
      </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
