<?php
$serverName = '127.0.0.1';
$userName = 'root';
$password = '';
$dbName = 'myshop';

// Create connexion
$connexion = new mysqli($serverName, $userName, $password, $dbName);

$id = '';
$name = '';
$email = '';
$phone = '';
$address = '';
if($_SERVER['REQUEST_METHOD'] == 'GET'){
    if(!isset($_GET['id'])){
        header('Location: /index.php');
        exit;
    }
    $id = $_GET['id'];
    $sql = "SELECT * FROM clients WHERE id = $id";
    $result = $connexion->query($sql);
    $row = $result->fetch_assoc();
    if(!$row){
        header('Location: /index.php');
        exit;
    }
    $name = $row['name'];
    $email = $row['email'];
    $phone = $row['phone'];
    $address = $row['address'];
}else{
    $id =  $_GET['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    do{
        if(empty($id) || empty($name) || empty($email) || empty($phone) || empty($address)){
            $errorMessage = 'All fields are required!';
            break;
        }

        $sql = "UPDATE clients SET name='$name', email='$email', phone='$phone', address='$address' WHERE id=$id";
        $result = $connexion->query($sql);

        if(!$result){
            $errorMessage = "Invalid Request :" . $connexion->error;
            break;
        }

        $successMessage = 'Client edited';
        header('Location: /index.php');
        exit;
    }while(false);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <title>Edit Client</title>
</head>
<body>
    <div class="container w-50">
        <h2>Edit Client</h2>

        <?php                             
            // Error message
            if(!empty($errorMessage)){
                echo "
                <div class='alert alert-danger alert-dismissible fade show' role='alert'>
                    <strong>{$errorMessage}</strong>
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                    </button>
                </div>
                ";
            }
        ?>

        <form method="post">
            <input type="hidden" value="<?php echo $id; ?>">
            <div class="form-group">
                <label for="name">Name</label>
                <input class="form-control" name="name" placeholder="Name" value=<?php echo $name; ?>>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" name="email" placeholder="Email" value=<?php echo $email; ?>>
            </div>
            <div class="form-group">
                <label for="phone">Phone</label>
                <input class="form-control" id="inputPhone" name="phone" placeholder="Phone" value=<?php echo $phone; ?>>
            </div>
            <div class="form-group">
                <label for="address">Address</label>
                <input class="form-control" name="address" placeholder="Address" value=<?php echo $address; ?>>
            </div>

                <?php 
                    // Success message
                    if(!empty($successMessage)){
                        echo "
                        <div class='alert alert-success alert-dismissible fade show' role='alert'>
                            <strong>{$successMessage}</strong>
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                            </button>
                        </div>
                        ";
                    }
                ?>

            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <a href="index.php" class="btn btn-danger">Cancel</a>
                </div>

                <div class="col-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>

        </form>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</html>