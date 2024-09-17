<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>

        .form-input{
            display:flex;
            justify-content:center;
        }

        
        /* .custom-input {
            width: 80px;
        } */

    </style>
</head>



<body>
    
    <div class="form-input container" >
        <div class="row d-flex justify-content-center mt-5">
            <div class="col-md-3">
            <input type="text" class="form-control custom-input mb-3 w-100" placeholder="Title">
            </div>
            <!-- <div class="col-md-3">
            <input type="text" class="form-control custom-input mb-3 w-100" placeholder="Author">
            </div> -->
            <!-- <div class="col-md-3">
            <input type="text" class="form-control custom-input mb-3 w-100" placeholder="ISBN">
            </div> -->

            <div class="col-md-3">
                <select class="form-select mb-3">
                    <option selected>Book catagory</option>
                    <option value="book1">Book 1</option>
                    <option value="book2">Book 2</option>
                    <option value="book3">Book 3</option>
                </select>
            </div>

            <div class="col-md-3">
                <select class="form-select mb-3">
                    <option selected>Author</option>
                    <option value="book1">Book 1</option>
                    <option value="book2">Book 2</option>
                    <option value="book3">Book 3</option>
                </select>
            </div>

            <div class="col-md-3">
            <button class="btn btn-primary w-80">Find Book</button>
            </div>
        </div>
    </div>
    



</body>
</html>