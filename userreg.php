<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f4f4f4;
        }
        
        .registration-form {
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        .btn{
            background:#0E8388;
            color:white;
        }
        header{
           
            display:flex;
            justify-content:center;
            margin-top:5%;
        }
        
        header h4{
            width:fit-content;
            padding:1%;
        }
    </style>
</head>
<body>
<section>
    <header>
        <h4>"register now to embark on your journey through our vast collection of books"</h4>
    </header>
</section>


<section>


<div class="container">
        <div class="registration-form">
            <h2 class="text-center">Registration Form</h2>
            <form action="insert.php" method="post">
                <div class="form-group">
                    <input type="text" id="name" name="name"  class="form-control" placeholder="Full Name" required>
                </div>
                <div class="form-group">
                    <input type="email" id="email" name="email" class="form-control" placeholder="Email" required>
                </div>
                <div class="form-group">
                    <input type="tel" id="phone" name="phone" class="form-control" placeholder="Phone" required>
                </div>
                <div class="form-group">
                    <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
                </div>

                <div class="form-group">
                    <select class="form-control" id="usertype" name="usertype">
                        <option value="" disabled selected>Select a Role</option>
                        <option value="user">User/buyer</option>
                        <option value="seller">Seller</option>
                        
                    </select>
                </div>

                <button type="submit" class="btn  btn-block">Register</button>
            </form>
        </div>
    </div>


</section>


   

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
        crossorigin="anonymous"></script>
</body>
</html>
