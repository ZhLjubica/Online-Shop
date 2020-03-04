<?php
 //include config file
 require_once "config/config.php";

    
    //define variables and initialize with empty values

    $name = $description = $price = "";
    $name_err = $description_err = $price_err = "";


    //processing form data when form is submitted
    if ($_SERVER['REQUEST_METHOD'] === "POST") {
        //validate name
        $input_name = trim($_POST["name"]);
        if (empty($input_name)) {
            $name_err = "Please enter a name!";
        }elseif(!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
            $name_err = "Please enter a vallid name.";
        }else{
            $name = $input_name;
        }
        //validate description
        $input_description = trim($_POST['description']);
        if (empty($input_description)) {
            $description_err = "Please enter an description!";
        }else{
            $description = $input_description; 
        }

        //validate price
        $input_price = trim($_POST["price"]);
        if (empty($input_price)) {
            $price_err = "Please enter the price amount!";
        }elseif(!ctype_digit($input_price)){
            $price_err = "Please enter a positive digit!";
        }else{
            $price = $input_price;
        }

        $random_alpha = md5(rand());

        $random_code = substr($random_alpha, 0, 6);

        $img = $_FILES['image']['name'];
        print_r($img);
        

        //check input errors before inserting in database
        if (empty($name_err) && empty($description_err) && empty($price_err)) {
            move_uploaded_file($_FILES['image']['tmp_name'],  "pictures/$img");
       
            //prepare an insert statement
            $sql = "INSERT INTO products (code, name, description, price, picture) VALUES (?,?,?,?,?)";

            if ($stmt = mysqli_prepare($link, $sql)) {
               

                mysqli_stmt_bind_param($stmt, "sssis", $param_code, $param_name, $param_description, $param_price, $param_image);

                //set parameters
                $param_code = $random_code;
                $param_name = $name;
                $param_description = $description;
                $param_price = $price;
                $param_image = "pictures/$img";

                //attempt to execute the prepared statement 
                if (mysqli_stmt_execute($stmt)) {
                    //records created successfully. Redirect to landing page
                    header("location: index.php");
                    exit();
                }else{
                    echo "Something went wrong. Please try leter!";
                }
            
            //close statement
            mysqli_stmt_close($stmt);
            }
        }
        //close connection
        mysqli_close($link);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add new product</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h2 class='display-3'>Add new product</h2>
                    </div>
                    <p>Please fill this form and submit to add new product to the database.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" enctype="multipart/form-data">
                        <div class="form-group <?php echo (!empty($name_err)) ? 'has-error': ''; ?>">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control" value="<?php echo $name; ?>">
                        <span class="help-block"><?php echo $name_err;?></span>
                    </div>
                    <div class="form-group <?php echo (!empty($description_err)) ? 'has-error' : ''; ?>">
                        <label>Description</label>
                        <textarea name="description" class="form-control"><?php echo $description; ?></textarea>
                        <span class="help-block"><?php echo $description_err; ?></span>
                    </div>
                        <div class="form-group <?php echo (!empty($price_err)) ? 'has-error': ''; ?>">
                        <label>Price</label>
                        <input type="text" name="price" class="form-control" value="<?php echo $price; ?>">
                        <span class="help-block"><?php echo $price_err; ?></span>
                        </div>
                        <label>Select image to upload</label>
                        <input type="file" name="image" >
                        <hr>
                        <input type="submit" name="submit" class="btn btn-primary" value="Submit">
                        <a href="index.php" class="btn btn-default">Cancel</a>
                    </form>
                </div>
            </div>
        </div>

    </div>
    
</body>
</html>