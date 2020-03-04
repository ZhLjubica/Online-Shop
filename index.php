
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>OnlineShop</title>
    <!-- Fontawesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
        integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <!--Jquery  -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <!-- Bootstrap -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css">


    <script>
        $(function () {
         $('[data-toggle="tooltip"]').tooltip()
})
    </script>
    <style>
       
        nav{
            height: 50px;
            background-color: darkcyan;
        }
        footer{
            height: 70px;
            background-color: darkcyan;
        }
        /* .collapse{
            height: 100px;
            background-color: darkcyan;
            opacity: 50%;
            display: block;
            
        } */
    </style>
</head>
<body>

<!-- <nav class="navbar navbar-expand-lg navbar-dark navbar-custom fixed-top">
    <div class="container">
      <a class="navbar-brand" href="#">Handmade shop</a>
      <button class="navbar-toggler navbar-button" type="button" data-togzgle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <a class="nav-link" href="index.php"></a>
          </li>
        <li class="nav-item">
            <a class="nav-link" href="index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="register.php">Sign up</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="register.php">Log In</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="users.php">Users</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <div class="hidden" style="display: none; height: 100px;">
 -->
 <nav>
        <div class="hamburger">
            <div class="line"></div>
            <div class="line"></div>
            <div class="line"></div>
        </div>
        <ul class="nav-links">
            <li><a href="index.php">Home</a></li>
            <li><a href="register.php">Sign up</a></li>
            <li><a href="register.php">Log in</a></li>
            <li><a href="users.php">Users</a></li>
        </ul>
    </nav>
  </div>
<div class="wrapper">
    <div class="container">
        <!-- <div class="row">  -->
            <div class="col-md-12 mt-5">
                <div class="page-header clearfix">
                    <h2 class="pull-left display-3"> Online Shop</h2>
                    <a href="create.php" class="btn float-right mb-md-3" style="background-color:darkcyan; color:white;">Add new product</a>
                </div>
                <?php
                    //include config file
                    require_once "config/config.php";

                    //attempt select query execution
                    $sql = "SELECT * FROM products";
                    if ($result = mysqli_query($link, $sql)) {
                        if (mysqli_num_rows($result)>0) {
                           echo "<div class='row' m-3>";
                            echo "<div class='col>";
                            while ($row = mysqli_fetch_array($result)) {
                                echo "<div class='card mb-5' style='width:250px; style='height: auto;'>";
                               echo "<img src='$row[picture]' class='card-img-top' alt='Gde je slika' style='height: 230px;' >";
                                echo "<div class='card-body'>";
                                  echo "<h5 class='card-title'>" . $row['name'] . "</h5>";
                                  echo "<p class='card-text'>". $row['description']."</p>";

                                  echo "<div class='text-center'>";
                                  echo "<button type='button' class='btn btn-secondary float-left'>Price: ". $row['price']."&euro;</button>";
                                    echo "<a href='read.php?id=" . $row['id'] . "' title='View Details' data-toggle='tooltip'>
                                    <i class='fas fa-eye'></i></a>";

                                    echo "<a href='update.php?id=" . $row['id'] . "' title='Update Product' data-toggle='tooltip'><i class='fas fa-pencil-alt'></i></a>";
                                    echo "<a href='delete.php?id=" . $row['id'] . "' title='Delete Product' data-toggle='tooltip'>
                                    <i class='fas fa-trash'></i></a>";
                                echo "</div>";
                               echo "</div>";
                                echo "</div>";
                                echo "<hr>";
                                echo "<br>";

                            }
                            echo "</div>";
                            echo "</div>";
                        mysqli_free_result($result);
                        }else{
                            echo "<p class='lead'><em>No records were found.</em></p>";
                        }
                    }else{
                        echo "ERROR: could not be able to execute $sql . " . mysqli_error($link);
                    }
                    //close connection
                    mysqli_close($link);
                ?>
            </div>
        </div>
    <!-- </div> -->
</div>
      
<!-- Footer -->
<footer class="py-5 bg-black">
    <div class="container">
      <p class="m-0 text-center text-white small">Copyright &copy; Handmade shop 2019</p>
    </div>
  </footer>

  
      <script>
      const hamburger = document.querySelector('.hamburger');
      const navLinks = document.querySelector('.nav-links');
      const links = document.querySelectorAll('.nav-links li');

      hamburger.addEventListener('click', () => {
      navLinks.classList.toggle('open');
          links.forEach(link => {
          link.classList.toggle('fade');
    })
});
      </script>



 
                    
</body>
</html>