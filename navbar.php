

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
        
    <style>
       .navtwo{
        display:flex;
        justify-content:center;
        background: #0E8388;
        
       }
       .navtwo a{
        text-decoration:none;
        color:white;
        padding:1%;
       }
       .navtwo a:hover{
        text-decoration:none;
        color:#0E8388;
        padding:1%;
        background: white;
       }

    </style>

</head>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">Rebooked</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse  nav-list" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-link active" aria-current="page" href="index.php">Home</a>

                    <a class="nav-link" href="allbooks.php">Used book</a>
                    <a class="nav-link" href="aboutus.php">about us</a>
                </div>
                <?php 
                    session_start();
                    if(isset($_SESSION["email"])){
                        
                        $email=$_SESSION["email"];
                        $name=$_SESSION["name"];
                        $id=$_SESSION["id"];
                        
                        echo "
                        <div class='navbar-nav'>
                            <a class='nav-link' href='user_profile.php?id=$id'>$name</a>
                            <a class='nav-link' href=''>$id</a>
                            <a class='nav-link' href='logout.php'>Logout</a>
                        </div>
                        ";

                    }else{
                        echo "<div class='navbar-nav'>
                            <a class='nav-link' href='login.php'>Sign In</a>
                            <a class='nav-link' href='userreg.php'>Create your Account</a>
                        </div> ";
                    }
                
                ?>
                
            </div>
        </div>
    </nav>
    


   <div>
       <div class="navtwo">
            <a href="http:poem.php">Poem</a>
            <a href="http:Personalfinance.php">Personal finance</a>
            <a href="http:fiction.php">Fiction</a>
       </div>             
   </div>

 </body>
        
