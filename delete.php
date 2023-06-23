<?php
if (isset($_GET["id"])) {
    $id = $_GET["id"];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "myshop";

    // Establish database connection
    $connection = new mysqli($servername, $username, $password, $database);

    if ($connection->connect_error) {
        die("Connection Failed: " . $connection->connect_error);
    }

    $sql = "DELETE FROM clients WHERE id = $id";
    if ($connection->query($sql) === true) {
        // Successful deletion
        header("Location: /myshop/index.php");
        exit;
    } else {
        // Error in the deletion process
        echo "Error: " . $connection->error;
    }

    $connection->close();
} else {
    // Invalid or missing client ID
    header("Location: /myshop/index.php");
    exit;
}
?>
