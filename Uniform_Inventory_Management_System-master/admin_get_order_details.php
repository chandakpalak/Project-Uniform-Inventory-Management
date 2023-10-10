<?php
// Assuming you have already established a database connection
// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "user_authentication_03";

// Establish the database connection
$connection = mysqli_connect($servername, $username, $password, $dbname);

// Check if the connection was successful
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

// Construct the SQL query to fetch order details
$sql = "SELECT * FROM customers natural join product natural join orders natural join order_item_details"; // Change 'orders' to your actual table name

// Execute the query
$result = mysqli_query($connection, $sql);

// Check if any results were found
if (mysqli_num_rows($result) > 0) {
    // Initialize an array to store order details
    $orderDetails = array();

    // Fetch each row of the result set and add it to the array
    while ($row = mysqli_fetch_assoc($result)) {
        $orderDetails[] = $row;
    }

    // Close the database connection
    mysqli_close($connection);

    // Send the order details as JSON response
    header("Content-Type: application/json");
    echo json_encode($orderDetails);
} else {
    // No orders found
    echo "No orders found";
}
?>
