<?php

use LDAP\Result;

$hostname = "localhost";
$username = "root";
$password = "";
$dbname = "vols";
$port = "3307";
$conn = mysqli_connect($hostname, $username, $password, $dbname,$port);

if (!$conn) {
    die("Failed to connect: " . mysqli_connect_error());
} else {
}
if (isset($_GET['delete'])) {
    $sno = $_GET['delete'];
    $delete = true;
    $sql = "DELETE FROM `infos` WHERE `infos`.`id` = $sno";
    $result = mysqli_query($conn, $sql);
    // if ($result) {
    //     echo "deleted";
    // } else {
    //     echo "failed to delete";
    // }
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $rollno = $_POST['roll'];
    $name = $_POST['name'];
    $imail = $_POST['imail'];
    $pmail = $_POST['pmail'];
    $address = $_POST['address'];
    $sql = "INSERT INTO infos (roll_no, name, i_mail, p_mail, address) VALUES ('$rollno', '$name', '$imail','$pmail','$address')";
    $result = mysqli_query($conn, $sql);
}

?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://kit.fontawesome.com/79129b46ef.js" crossorigin="anonymous"></script>



    <title>VOLSEC</title>

</head>

<body>
    <nav class="navbar navbar-expand-lg bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">VOLSEC</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent" style="display: flex; justify-content: space-between;">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contact Me</a>
                    </li>

                </ul>
                <form class="d-flex" role="search" style="display: flex; gap: 10px">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container">
        <h4>Add data</h4>
        <form action="/crud/index.php" method="post">
            <div class="field roll">
                <label for="roll">Roll No</label>
                <input type="text" name="roll" id="roll" required>
            </div>
            <div class="field name">
                <label for="name">Full Name</label>
                <input type="text" name="name" id="Name" required>
            </div>
            <div class="field iemail">
                <label for="iemail">Institute email</label>
                <input type="email" name="imail" id="iemail">
            </div>
            <div class="field pemail">
                <label for="pemail">Personal email</label>
                <input type="email" name="pmail" id="pemail">
            </div>
            <div class="field address">
                <label for="address">Address</label>
                <input type="text" name="address" id="address">
            </div>
            <button type="submit" onclick="<?php header("Location: ./index.php") ?>">Submit</button>

        </form>
    </div>

    <div class="container my-4">
        <table class="table my-2" id="myTable">
            <thead>
                <tr>
                    <th scope="col">S.No</th>
                    <th scope="col">Roll Number</th>
                    <th scope="col">Name</th>
                    <th scope="col">Institute email</th>
                    <th scope="col">Personal email</th>
                    <th scope="col">Address</th>
                    <th scope="col">Updated on</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM infos";
                $result = mysqli_query($conn, $sql);

                $sno = 0;
                while ($row = mysqli_fetch_assoc($result)) {
                    $sno = $sno + 1;
                    echo "<tr>
                    <th scope = 'row'> " . $sno . "</th>
                    <td> " . $row['roll_no'] . "</td>
                    <td> " . $row['name'] . "</td>
                    <td> " . $row['i_mail'] . "</td>
                    <td> " . $row['p_mail'] . "</td>
                    <td> " . $row['address'] . "</td>
                    <td> " . $row['date_time'] . "</td>
                    <td><button id =" . $row['id'] . " class = 'delete btn btn-danger my-1'>Delete</button> 
                </td>

                    </tr>";
                }

                ?>
            </tbody>
        </table>
    </div>
    <hr>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script>
    <script>
        deletes = document.getElementsByClassName('delete');
        Array.from(deletes).forEach((element) => {
            element.addEventListener("click", (e) => {
                tr = e.target.parentNode.parentNode
                roll = tr.getElementsByTagName('td')[0].innerText;
                name = tr.getElementsByTagName('td')[1].innerText;
                imail = tr.getElementsByTagName('td')[2].innerText;
                pmail = tr.getElementsByTagName('td')[3].innerText;
                address = tr.getElementsByTagName('td')[4].innerText;
                sno = e.target.id;
                console.log(e.target.id);

                if (confirm("Do you want to delete this !")) {
                    console.log("Yes")
                    window.location = `/crud/index.php?delete=${sno}`;
                } else {
                    console.log("No")
                }

            })
        })
    </script>
</body>

</html>
