<?php
include 'db.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['create'])) {
    $name = $conn->real_escape_string($_POST['name']);
    $price = $conn->real_escape_string($_POST['price']);
    $description = $conn->real_escape_string($_POST['description']);

    $sql = "INSERT INTO products (name, price, description) VALUES ('$name', '$price', '$description')";
    $conn->query($sql);
}


$result = $conn->query("SELECT * FROM products");


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
    $id = $conn->real_escape_string($_POST['id']);
    $name = $conn->real_escape_string($_POST['name']);
    $price = $conn->real_escape_string($_POST['price']);
    $description = $conn->real_escape_string($_POST['description']);

    $sql = "UPDATE products SET name='$name', price='$price', description='$description' WHERE id='$id'";
    $conn->query($sql);
}


if (isset($_GET['delete'])) {
    $id = $conn->real_escape_string($_GET['delete']);
    $conn->query("DELETE FROM products WHERE id='$id'");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <title>CRUD Products</title>
</head>
<body>
<div class="container mt-5">
    <h2>Product Management</h2>

    
    <form method="POST" class="mb-4">
        <div class="form-group">
            <input type="text" name="name" class="form-control" placeholder="Product Name" required>
        </div>
        <div class="form-group">
            <input type="number" name="price" class="form-control" placeholder="Price" required>
        </div>
        <div class="form-group">
            <textarea name="description" class="form-control" placeholder="Description"></textarea>
        </div>
        <button type="submit" name="create" class="btn btn-primary">Add Product</button>
    </form>

    
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Price</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['price']; ?></td>
                    <td><?php echo $row['description']; ?></td>
                    <td>
                        <a href="edit.php?id=<?php echo $row['id']; ?>" class="btn btn-warning">Edit</a>
                        <a href="?delete=<?php echo $row['id']; ?>" class="btn btn-danger">Delete</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>
</body>
</html>