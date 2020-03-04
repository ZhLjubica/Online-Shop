<?php
    //ckeck existence of id parameter before processing further

    if (isset($_GET["id"]) && !empty(trim($_GET["id"]))) {
        //include config file
        require_once "config/config.php";

         // prepare a select statement
         $sql = "SELECT * FROM products WHERE id=?";

         if ($stmt = mysqli_prepare($link, $sql)) {
             mysqli_stmt_bind_param($stmt, "i", $param_id);

             //set parametres
             $param_id = trim($_GET["id"]);

             //attempt to execute the prepared statement
             if (mysqli_stmt_execute($stmt)) {
                 $result = mysqli_stmt_get_result($stmt);

                 if (mysqli_num_rows($result)==1) {
                     /* Fetch result row as an associative array. Since the result set contains only one row, we don't need to use while loop */
                     $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

                     //retrieve individual field value
                     $name = $row["name"];
                     $code = $row["code"];
                     $description = $row["description"];
                     $price = $row["price"];
                     $picture = $row["picture"];
                 }else{
                     //URL doesn't contain valid id parameter.
                     //redirect to error page
                     header("location: error.php");
                     exit();
                 }
             }else{
                 echo "Oops! Something went wrong! Please try again leter.";
             }
         }
         //close statement
         mysqli_stmt_close($stmt);

         //close conncection
         mysqli_close($link);
    }else{
        //URL doesn't contain id parametar. resirect to error page
        header("location: error.php");
        exit();
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>View Details</title>
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
                    <h1>View Details</h1>
                </div>
                <div class="form-group">
                    <label>Name</label>
                    <p class="form-control-static"><?php echo $row["name"]; ?></p>
                </div>
                <div class="form-group">
                    <label>Code</label>
                    <p class="form-control-static"><?php echo $row["code"]; ?></p>
                </div>
                <div class="form-group">
                    <label>Description</label>
                    <p class="form-control-static"><?php echo $row["description"]; ?></p>
                </div>
                <div class="form-group">
                    <label>Price</label>
                    <p class="form-control-static"><?php echo $row["price"]; ?></p>
                </div>
                <div class="form-group">
                    <label>Picture</label>
                    <div class="form-control-static img-fluid">
                        <img class="img-thumbnail" src="<?php echo $row["picture"]; ?>">
                    </div>
                </div>
                <p><a href="index.php" class="btn btn-primary">Back</a></p>
            </div>
        </div>
    </div>
</body>
</html>