<?php
// include database connection file
require_once 'dbconfig.php';

if (isset($_POST['update'])) {
    // Get the userid

    // Posted Values
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Database Connection
    $conn = new mysqli("localhost", "root", "", "signup");

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Query for Updation
    $sql = "UPDATE users SET UserName='$username', EmailId='$email', Password='$password', WHERE email=$email";

    // Query Execution
    if ($conn->query($sql) === TRUE) {
        // Message after updation
        echo "<script>alert('Record Updated successfully');</script>";
        // Code for redirection
        echo "<script>window.location.href='index.php'</script>";
    } else {
        echo "Error updating record: " . $conn->error;
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title> My SQL Project </title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
</head>

<body>

    <div class="container">

        <div class="row">
            <div class="col-md-12">
                <h3>Update Record | My SQL Project</h3>
                <hr />
            </div>
        </div>

        <?php
        // Get the userid
        $userid = intval($_GET['id']);
        $sql = "SELECT UserName, EmailId, Password, from users where email=$email";

        // Database Connection
        $conn = new mysqli("localhost", "root", "", "signup");

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Execute the query
        $result = $conn->query($sql);

        // For serial number initialization
        $cnt = 1;

        if ($result->num_rows > 0) {
            // In case that the query returned at least one record, we can echo the records within a while loop:
            while ($row = $result->fetch_assoc()) {
        ?>
                <form name="insertrecord" method="post">
                    <div class="row">
                        <div class="col-md-4"><b>User Name</b>
                            <input type="text" name="username" value="<?php echo htmlentities($row['UserName']); ?>" class="form-control" required>
                        </div>
                        <div class="col-md-4"><b>Email id</b>
                            <input type="email" name="email" value="<?php echo htmlentities($row['EmailId']); ?>" class="form-control" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-8"><b>Password</b>
                            <input type="password" name="password" value="<?php echo htmlentities($row['Password']); ?>" class="form-control" required>
                        </div>
                    </div>
        <?php }
        } ?>

                    <div class="row" style="margin-top:1%">
                        <div class="col-md-8">
                            <input type="submit" name="update" value="Update">
                        </div>
                    </div>
                </form>

    </div>
    </div>

</body>

</html>