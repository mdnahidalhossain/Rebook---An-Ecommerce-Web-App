<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
        

    <style>
        .pop-book{
            height:600px;
        }
    </style>
</head>

<body>
   <?php include "navbar.php" ?>

   <div class="container mt-5 pop-book">
      <div class="row row-cols-md-2">
            <?php
                include "server.php";

                $sql = "SELECT title, author, price, book_cover FROM books where genre='Poem'";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
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
            
    
           
            $conn->close();
            
            
            ?>
      </div>
    </div>


    <section>
        <?php include "footer.php" ?>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
        crossorigin="anonymous"></script>
</body>

</html>