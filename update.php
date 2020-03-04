<?php
    //include config file
    require_once "config/config.php";

    //define variables and initialize with empty values
    $name = $description = $price = "";
    $name_err = $description_err = $price_err = "";

    //processing form data when form is submitted
    if (isset($_POST["id"]) && !empty($_POST["id"])) {
        $id = $_POST["id"];

        //validate name
        $input_name = trim($_POST["name"]);
        if (empty($input_name)) {
            $name_err = "Please enter a name!";
        }elseif(!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
            $name_err = "Please enter a valid name!";
        }else{
            $name = $input_name;
        }
        //validate address
        $input_description = trim($_POST['description']);
        if (empty($input_description)) {
            $description_err = "Please enter an description of product!";
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

        //check input errors before inserting in database
        if (empty($name_err) && empty($description_err) && empty($price_err)) {
            //prepare an update statement
            $sql = "UPDATE products SET name=?, description=?, price=? WHERE id=?";

            if ($stmt = mysqli_prepare($link, $sql)) {
                //bind variables to the prepand statement as parameters
                mysqli_stmt_bind_param($stmt, "ssii", $param_name, $param_description, $param_price, $param_id);

                //set parameters
                $param_name = $name;
                $param_description = $description;
                $param_price = $price;
                $param_id = $id;

                //attempt to execute the prepered statement
                if (mysqli_stmt_execute($stmt)) {
                    //records updaated successfully. redirect to landing page
                    header("location: index.php");
                    exit();
                }else{
                    echo "Something went wrong! Please try again leter.";
                }
            }
            //close statement
            mysqli_stmt_close($stmt);
        }
        //close connection
        mysqli_close($link);

    }else{
        //check existance of id parameter before processing further
        if (isset($_GET["id"]) && !empty(trim($_GET["id"]))) {
            $id = trim($_GET["id"]);

            //prepare a select statement
            $sql = "SELECT * FROM products WHERE id = ?";
            if ($stmt = mysqli_prepare($link, $sql)) {
                mysqli_stmt_bind_param($stmt, "i", $param_id);
                $param_id = $id;

                if (mysqli_stmt_execute($stmt)) {
                    $result = mysqli_stmt_get_result($stmt);
                    if (mysqli_num_rows($result) == 1) {
                        
                        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

                        $name = $row["name"];
                        $description = $row["description"];
                        $price = $row["price"];
                    }else{
                        //URL doesn't contain valid id. Redirect to error page
                        header("location: error.php");
                        exit();
                    }
                }else{
                    echo "Oops! Something went wrong. Please try again leter.";
                }
            }
            mysqli_stmt_close($stmt);
            mysqli_close($link);
        }else{
            header("location: error.php");
            exit();
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Update</title>
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
                        <h2>Update informations</h2>
                    </div>
                    <p>Please edit the input values and submit to update the informations about product.</p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI']))?>" method="POST">
                        <div class="form-group<?php echo (!empty($name_err)) ? 'has-error': ''; ?>">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" value="<?php echo $name; ?>">
                            <span class="help-block"><?php echo $name_err;?></span>
                        </div>
                        <div class="form-group<?php echo (!empty($description_err)) ? 'has-error': ''; ?>">
                            <label>Description</label>
                            <textarea name="description" class="form-control"><?php echo $description;?></textarea>
                            <span class="help-block"><?php echo $description_err; ?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($price_err)) ? 'has-error' : ''; ?>">
                            <label>Price</label>
                            <input type="text" name="price" class="form-control" value="<?php echo $price; ?>">
                            <span class="help-block"><?php echo $price_err;?></span>
                        </div>
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="index.php" class="btn btn-default">Cancel</a>
                </form>
                </div>
            </div>
        </div>
    </div>
    
</body>
</html>