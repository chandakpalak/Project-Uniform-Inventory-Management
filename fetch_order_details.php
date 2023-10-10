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
// Check if the name parameter is set in the URL
if (isset($_GET['Customer_Name'])) {
    $Customer_Name = $_GET['Customer_Name'];
    
    // Construct the SQL query to fetch order details for the given client name
    $sql = "SELECT * FROM customers natural join product natural join orders natural join order_items
     WHERE customers.Customer_Name = '$Customer_Name'";
    
    // Execute the query
    $result = mysqli_query($connection, $sql);
    
    // Check if any results were found
    if (mysqli_num_rows($result) > 0) {
        // Start building the order details table
        $table = '<table class="order-table">';
        $table .= '<tr><th>Order ID</th><th>Client Name</th><th>Product Type</th><th>Size</th><th>Color</th><th>Quantity</th></tr>';
        
        // Fetch each row of the result set
        while ($row = mysqli_fetch_assoc($result)) {
            // Extract the order details from the row
            $Order_id = $row['Order_id'];
            $Customer_Name = $row['Customer_Name'];
            $Product_type = $row['Product_type'];
            $Size = $row['Size'];
            $Color = $row['Color'];
            $Quantity = $row['Quantity'];
            
            // Add a new row to the table for each order
            $table .= "<tr><td>$Order_id</td><td>$Customer_Name</td><td>$Product_type</td><td>$Size</td><td>$Color</td><td>$Quantity</td></tr>";
        }
        
        // Close the table
        $table .= '</table>';
        
        // Display the table on the page
        echo $table;
    } else {
        // No results found for the given client name
        echo "No orders found for client: $Customer_Name";
    }
}

// Close the database connection
mysqli_close($connection);
?>