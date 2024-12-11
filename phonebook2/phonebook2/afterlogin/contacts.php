<?php

// Enable error reporting for mysqli
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
// Hostname
$host = "localhost";

// Username
$user = "id21003530_bebicmikael";

// Password
$pass = "12345-Bebic";

// Database Name
$db   = "id21003530_login";


$con = new mysqli("localhost","id21003530_bebicmikael","12345-Bebic","id21003530_login");
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

// Display Table data
$tabledata = "";
$sqlsearch = "";
if (isset($_POST["btnSearch"])) {
    $keywords = $con->real_escape_string($_POST["txtSearch"]);
    $searchTerms = explode(' ', $keywords);
    $searchTermBits = array();
    foreach ($searchTerms as $key => $term) {
        $term = trim($term);
        $searchTermBits[] = " first_name LIKE '%$term%' OR last_name LIKE '%$term%' OR address LIKE '%$term%' OR phone_number LIKE '%$term%' OR email LIKE '%$term%'";
    }
    $sqlsearch = " WHERE " . implode(' AND ', $searchTermBits);
}

if ($stmt = $con->prepare("SELECT * FROM contacts $sqlsearch")) {
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $tabledata .= '<tr>
                            <td> ' . $row["id"] . '</td>
                            <td>' . $row["first_name"] . '</td>
                            <td>' . $row["last_name"] . '</td>
                            <td>' . $row["address"] . '</td>
                            <td>' . $row["phone_number"] . '</td>
                            <td>' . $row["email"] . '</td>
                            <td>
                                <a href="update.php?id=' . $row["id"] . '" class="link-dark"><i class="fa-solid fa-pen-to-square fs-5 me-3"></i></a>
                                <a href="delete.php?id=' . $row["id"] . '" class="link-dark"><i class="fa-solid fa-trash fs-5"></i></a>
                            </td>
                            </tr>';
        }
    } else {
        $tabledata = '<tr><td colspan="4" style="text-align: center; padding:30px 0;">Nothing Found</td></tr>';
    }

    $stmt->close();
} else {
    
}

// Close database connection
$con->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />


    <style>
body {
    margin: 10em;
}
button, input, optgroup, select, textarea {
    margin: 0;
    font-family: inherit;
    font-size: inherit;
    line-height: inherit;
    position: relative;
    left: 50em;
    top: 3em;
}
    </style>
    <title>Contacts</title>
</head>

<body>
<?php if(isset($msg)){ echo $msg; }?>
    
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <input type="text" name="txtSearch" value="<?php if (isset($keywords)) {
                                                            echo $keywords;
                                                        } ?>" title="Input keywords here" required>
            <button type="submit" name="btnSearch" class="btn btn-dark mb-3" title="Search keywords">Search</button>
            <button type="" formaction="search.php" class="btn btn-dark mb-3">Reset</button>
        </form>
        <a href="create.php" class="btn btn-dark mb-3">Add New</a>
        <a href="phonebook.php" class="btn btn-dark mb-3">Go home</a>

        <table class="table table-hover text-center">
            <thead class="table-dark">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">First Name</th>
                    <th scope="col">Last Name</th>
                    <th scope="col">Address</th>
                    <th scope="col">Phone Number</th>
                    <th scope="col">Email</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                echo $tabledata;
                ?>
            </tbody>
        </table>
    </div>

    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</body>

</html>