<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <title>myShop</title>
</head>

<body>
    <div class="container my-5">
        <h2 class="text-center">myShop</h2>
        <a href="./createClient.php" class="btn btn-primary">Add client</a>
        <table>
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Address</th>
                    <th scope="col">Created At</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $serverName = '127.0.0.1';
                $userName = 'root';
                $password = '';
                $dbName = 'myshop';
                // Create connexion

                $connexion = new mysqli($serverName, $userName, $password, $dbName);

                //verify if db is connected
                if ($connexion->connect_error) {
                    die('Connection Error : ' . $connexion->connect_error);
                }
                $sql = 'SELECT * FROM clients';
                $result = $connexion->query($sql);

                if (!$result) {
                    die('Invalid SQL Request :' . $connexion->connect_error);
                }

                while ($row = $result->fetch_assoc()) {
                    echo "
                        <tr>
                            <td>" . $row['id'] . "</td>
                            <td>" . $row['name'] . "</td>
                            <td>" . $row['email'] . "</td>
                            <td>" . $row['phone'] . "</td>
                            <td>" . $row['address'] . "</td>
                            <td>" . $row['createdAt'] . "</td>
                            <td>
                                <a class='btn btn-secondary' href='/editClient.php?id=$row[id]'>Edit</a> 
                                <a class='btn btn-danger' href='./deleteClient.php?id=$row[id]'>Delete</a>
                            </td>
                        </tr>
                        ";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</html>