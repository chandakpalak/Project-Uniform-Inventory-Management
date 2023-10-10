<?php
// Assuming you have a database table named "users" with columns: id, name, email, password
$conn = mysqli_connect("localhost", "username", "password", "database_name");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch user details
$query = "SELECT * FROM users";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $id = $row["id"];
        $name = $row["name"];
        $email = $row["email"];
        
        // Process the user details as needed
        // You can display them, store them in an array, or use them in any other way
    }
} else {
    echo "No users found.";
}

mysqli_close($conn);
?>
