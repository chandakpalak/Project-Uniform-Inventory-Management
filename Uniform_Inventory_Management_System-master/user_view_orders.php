


<?php
// Assuming you have already established a database connection
// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "user_authentication_03";
echo "<link rel='stylesheet' type='text/css' href='fetch_order_details.css'>";
// Establish the database connection
$connection = mysqli_connect($servername, $username, $password, $dbname);

// Check if the connection was successful
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

session_start();
$user_id = implode(" ",$_SESSION['get_user_id']);
// Construct the SQL query to fetch all orders
$sql = "SELECT * FROM users natural join customers natural join product natural join orders natural join order_items
WHERE users.user_id =$user_id ";

// Execute the query
$result = mysqli_query($connection, $sql);

// Check if any results were found
if (mysqli_num_rows($result) > 0) {
    // Create a table to display the orders
    echo '<table class="order-table" border="1">';
    echo '<tr><th>Order ID</th><th>Client Name</th><th>Client Email-Id</th><th>Product Type</th><th>Size</th><th>Color</th><th>Quantity</th><th>Order Date/Time</th><th>Delivery Address</th></tr>';

    // Fetch each row of the result set
    while ($row = mysqli_fetch_assoc($result)) {
        // Display the order details in each row
        echo '<tr>';
        echo '<td>' . $row['Order_id'] . '</td>';
        echo '<td>' . $row['Customer_Name'] . '</td>';
        echo '<td>' . $row['Customer_Email'] . '</td>';
        echo '<td>' . $row['Product_type'] . '</td>';
        echo '<td>' . $row['Size'] . '</td>';
        echo '<td>' . $row['Color'] . '</td>';
        echo '<td>' . $row['Quantity'] . '</td>';
        echo '<td>' . $row['Order_date'] . '</td>';
        echo '<td>' . $row['Delivery_Address'] . '</td>';
        echo '</tr>';
    }

    // Close the table
    echo '</table>';
} else if(mysqli_num_rows($result)==null){
    echo "No orders found";
}
else {
    // No orders found
    echo 'No orders found.';
}

// Close the database connection
mysqli_close($connection);
?>