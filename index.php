<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>My_Shop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  </head>
  <body>
    <div class="container my-5">
        <h2>Lists of Clinets</h2>
        <a class="btn btn-primary" href="/myshop/create.php" role="button">New Clinet</a>
        <br>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone </th>
                    <th>Address </th>
                    <th>Created at</th>
                    <th>Action</th>
                </tr>

            </thead>
            <tbody>
                <?php
                $servername = "localhost";
                $username = "root";
                $password = "";
                $database ="myshop";

                 // database connection 
                 $connection = new mysqli($servername,$username,$password,$database);

                 //check connection

                 if($connection -> connect_error){
                    die("Connection Failed: ". $connection-> connect_error);
                 }


                 //read all row from database
                 $sql = "SELECT * FROM clients";
                 $result = $connection->query($sql);

                 if(!$result){
                    die("Invalid query: ".$connection->error);
                    
                 }

                 while($row = $result->fetch_assoc()){
                    echo " 
                    <tr>
                    <td>$row[id]</td>
                    <td>$row[name]</td>
                    <td>$row[email]</td>
                    <td>$row[phone]</td>
                    <td>$row[address]</td>
                    <td>$row[created_at]</td>
                    <td>
                        <a class='btn btn-primary btn-sm' href='/myshop/edit.php?id=$row[id]' >EDIT</a>
                        <a class='btn btn-danger btn-sm' href='/myshop/delete.php?id=$row[id]' >DELETE</a>
                    </td>
                </tr>
                    
                    ";
                 }

                ?>

               



                


            </tbody>







        </table>
    
    
    
    </div>

































    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
  </body>
</html>