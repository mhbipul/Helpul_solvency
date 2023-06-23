<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "myshop";

// database connection 
$connection = new mysqli($servername, $username, $password, $database);

$id = "";
$name = '';
$email = '';
$address = '';
$phone = '';

$errorMessage = "";
$successMessage = "";


if($_SERVER['REQUEST_METHOD']=="GET"){
    //get method: shows the data of the client

    if(!isset($_GET["id"])){
        header("location:/myshop/index.php");
        exit;
    }
    $id = $_GET["id"];

    $sql = "SELECT * FROM clients WHERE id=$id";
    $result = $connection->query($sql);
    $row = $result->fetch_assoc();

    if(!$row){
        header("location: /myshop/index.php");
        exit;
    }

    $name = $row["name"];
    $email = $row["email"];
    $phone = $row["phone"];
    $address = $row["address"];
}
else{
    //post method: update the data of the client
    $id = $_POST["id"];
    $name = $_POST["name"];
    $address = $_POST["address"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];

    do {
        if (empty($name) || empty($email) || empty($phone) || empty($address)) {
            $errorMessage = "All the fields are required";
            break;
        }
        
        $sql = "UPDATE clients SET name='$name', email='$email', phone='$phone', address='$address' WHERE id=$id";
        $result = $connection->query($sql);

        if (!$result) {
            die("Invalid query: " . $connection->error);
        }

        $successMessage = "Client updated correctly";
        header("location: /myshop/index.php");
        exit;
    } while (false);
}


?>



<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Adding_New_Client</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  </head>
  <body>

    <div class="container my-5">

        <h2>New Client</h2>
        <?php
        if (!empty($errorMessage)) {
            echo '
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>' . $errorMessage . '</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
        }
        


        ?>
        <form action="" method="post">
        <input type="hidden" name="id" value="<?php echo $id; ?>">

            <div class="row mb-3">
                <label for="" class="col-sm-3 col-form-label">Name</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name ='name' value='<?php echo "$name";  ?>'>
                </div>
                <br>

                <div class="row mb-3">
                <label for="" class="col-sm-3 col-form-label">Email</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name ='email' value='<?php echo "$email";  ?>'>
                </div>
                <br>

                <div class="row mb-3">
                <label for="" class="col-sm-3 col-form-label">Phone</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name ='phone' value='<?php echo "$phone";  ?>'>
                </div>
                <br>


                <div class="row mb-3">
                <label for="" class="col-sm-3 col-form-label">Address </label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name ='address' value='<?php echo "$address";  ?>'>
                </div>
                <br>



                <?php
                    if (!empty($successMessage)) {
                        echo '
                        <div class="row mb-3">
                            <div class="offset-sm-3 col-sm-6">
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <strong>' . $successMessage . '</strong>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Success"></button>
                                </div>
                            </div>
                        </div>';
                    }
                    ?>




                <div class="row mb-3">
                    <div class="offset-sm-3 col-sm-3 d-grid">
                        <button type='submit' class="btn btn-primary">Submit</button>

                    </div>
                    <div class="offset-sm-3 col-sm-3 d-grid">
                        <a class="btn btn-outline-primary" href="/myshop/index.php" role="button">Cancel</a>
                    </div>
                </div>

            </div>
        </form>


    </div>
































    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
  </body>
</html>