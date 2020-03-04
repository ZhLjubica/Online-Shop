<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Users</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
        integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <style>
        .wrapper{
            width: 650px;
            margin: 0 auto;
        }
        .page-header h2{
            margin-top: 0;
        }
        .table tr td:last-child a {
            margin-right: 15px;
        }
        nav{
            height: 50px;
            background-color: darkcyan;
        }
    </style>
    <script type="text/javascript">
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
        });
    
    </script>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark navbar-custom fixed-top">
    <div class="container">
      <a class="navbar-brand" href="#">Handmade shop</a>
      <button class="navbar-toggler navbar-button" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="index.php">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="register.php">Sign up</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="register.php">Log In</a>
            </li>
        </ul>
      </div>
    </div>
  </nav>

<div class="wrapper">
    <div class="container-fluid mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="page-header clearfix mb-5">
                    <h2 class="pull-left"> Users details</h2>
                    <div class="input-group mb-3 mt-3" id="filterUser" style="width: 50%;">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-search"></i></span>
                        </div>
                        <input type="text" class="form-control" placeholder="Search users by name" aria-label="Username">
                    </div>
                </div>
                <?php
                    //include config file
                    require_once "config/config.php";

                    //attempt select query execution
                    $sql = "SELECT * FROM users_table";
                    if ($result = mysqli_query($link, $sql)) {
                        if (mysqli_num_rows($result)>0) {
                            echo "<table class='table table-bordered table-striped' id='usersTable'>";
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>#</th>";
                                        echo "<th>Name</th>";
                                        echo "<th>Last name</th>";
                                        echo "<th>Username</th>";
                                        echo "<th>Email</th>";
                                        echo "<th>Image</th>";
                                        echo "<th>Action</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while ($row = mysqli_fetch_array($result)) {
                                    echo "<tr class='tableRow'>";
                                        echo "<td>" . $row['id'] . "</td>"; 
                                        echo "<td>" . $row['first_name'] . "</td>"; 
                                        echo "<td>" . $row['last_name'] . "</td>"; 
                                        echo "<td>" . $row['username'] . "</td>";
                                        echo "<td>" . $row['email'] . "</td>";
                                        echo "<td> <img src=".$row['profile_pic']."></img></td>";
                                        echo "<td>";
                                            
                                            echo "<a href='updateUsers.php?id=" . $row['id'] . "' title='Update User' data-toggle='tooltip'><i class='fas fa-pencil-alt'></i></a>";          
                                            echo "<a href='deleteUser.php?id=" . $row['id'] . "' title='Delete User' data-toggle='tooltip'>
                                            <i class='fas fa-trash'></i></a>";           
                                            echo "</td>";
                                        echo "</tr>";

                                }
                            echo "</tbody>";
                        echo "</table>";
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
    </div>

</div>  
<script>


//filtriranje tabele po nazivu
let filterTable= document.getElementById('usersTable');
let filter = document.getElementById('filterUser');
filter.addEventListener('keyup', filterItems);


function filterItems(e){
   let text = e.target.value.toLowerCase();
   let rows = filterTable.getElementsByClassName('tableRow');

   console.log(rows);

   Array.from(rows).forEach(function (item) {
      let itemName = item.getElementsByTagName('td')[1].innerText;
      // console.log(itemName);

      if (itemName.toLowerCase().indexOf(text) !=-1) {
         item.style.display = 'table-row';
      }else{
         item.style.display = 'none';
      }
   })
}

</script>

</body>
</html>