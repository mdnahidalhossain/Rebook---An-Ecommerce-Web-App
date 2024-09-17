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
        
</head>

<body>
   <?php include "navbar.php" ?>

    
    <section>
        <div class="banner">
        <video autoplay loop muted>
        <source src="images/bg.mp4" type="video/mp4">
                 
        </video>
                
            </div>
        </div>
    </section>


    <section>
        <div class="quotes">

            <div id="textCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <p class="h6">Reading is best for getting idea</p>
                    <p>Start Reading Books</p>
                </div>
                <div class="carousel-item">
                    <p class="h6">A reader lives a thousand lives before he dies, said Jojen. The man who never reads lives only one.</p>
                    
                </div>
                <div class="carousel-item">
                    <p class="h6">"The more that you read, the more things you will know. The more that you learn, the more places you'll go."</p>
                    
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#textCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#textCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
            </button>
        </div>
        </div>




        </div>
    </section>


    <section>
        <?php include "populerBooks.php" ?>
    </section>


    <section >
        <div class="browse-book">
            <a href="http:allbooks.php"><h6 class="browse-text">browse all collection &rarr;</h6></a>
            
        </div>
    </section>


    <section>
        <?php include "footer.php" ?>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
        crossorigin="anonymous"></script>
</body>

</html>
