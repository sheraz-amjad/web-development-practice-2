<?php
// include database connection file

// Code for record deletion
if (isset($_REQUEST['del'])) {
    // Get row id
    $uid = intval($_GET['del']);

    // Database Connection
    $conn = new mysqli("localhost", "root", "", "signup");

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Query for deletion
    $sql = "DELETE FROM users WHERE  email=$email";

    // Query Execution
    if ($conn->query($sql) === TRUE) {
        // Message after deletion
        echo "<script>alert('Record Deleted successfully');</script>";
        // Code for redirection
        echo "<script>window.location.href='index.php'</script>";
    } else {
        echo "Error deleting record: " . $conn->error;
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>My SQL Project</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet">
    <style type="text/css">

    </style>
    <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="https://getbootstrap.com/dist/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3>My Sql Project </h3> <hr />
                <div class="table-responsive">
                    <table id="mytable" class="table table-bordred table-striped">
                        <thead>
                            <th>#</th>
                            <th>username</th>
                            <th>email</th>
                            <th>password</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </thead>
                        <tbody>

                            <?php
                            $sql = "SELECT username, email, password, FROM users";

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
                                    <tr>
                                        <td><?php echo htmlentities($cnt); ?></td>
                                        <td><?php echo htmlentities($row['username']); ?></td>
                                     
                                        <td><?php echo htmlentities($row['email']); ?></td>
                                        <td><?php echo htmlentities($row['password']); ?></td>

                                        <td><a href="update1.php?email=<?php echo htmlentities($row['email']); ?>"><button class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-pencil"></span></button></a></td>

                                        <td><a href="index1.php?del=<?php echo htmlentities($row['email']); ?>"><button class="btn btn-danger btn-xs" onClick="return confirm('Do you really want to delete');"><span class="glyphicon glyphicon-trash"></span></button></a></td>
                                    </tr>

                            <?php
                                    // for serial number increment
                                    $cnt++;
                                }
                            } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <!-- textaddneww -->
    <ins class="adsbygoogle" style="display:inline-block;width:728px;height:15px" data-ad-client="ca-pub-8906663933481361" data-ad-slot="3318815534"></ins>
    <script>
        (adsbygoogle = window.adsbygoogle || []).push({});
    </script>
</body>

</html>
