<!-- <!DOCTYPE html>
<html>
<head>
    <title>Home</title>
    <link rel="stylesheet" type="text/css" href="style_home_page.css">
    <style>
    h1{
        color: rgb(74, 113, 113);
    }
    body{
        font-size: larger;
        color: white;
    }
    form{
        background-color: rgb(33, 128, 130);
        width: 50%;
        margin-left: auto;
        margin-right: auto;
        padding: 10px;
    }
     /* table{ 

     } */
    input{
        width: 100%;
        padding: 8px;
        border-radius: 3px;
        border: 0px solid;
    }
    textarea{
        width: 100%;
    }
    button{
        background-color: rgb(203, 230, 203);
        border: 0px solid;
        padding: 8px;
        font-size: large;
        border-radius: 5px;
    }
    select{
        padding: 8px;
        width:100%;
    }
</style>
</head>
<body>
    <header>
        <nav>
            <div class="container">
                <h1>Welcome to the Admin Portal !!</h1>
                <ul>
                    <li><a href="admin_dashboard.php">New Order</a></li>
                    <li><a href="admin_view_orders.php">View Orders</a></li>
                    <li><a href="order_details.html">Search Order</a></li>
                      <li><a href="#">Track Order</a></li>  `
                     <li><a href="logout.php">Logout</a></li>
                </ul>
            </div>
        </nav>
</header>  -->


<?php
// Assuming you have already established a database connection
// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "user_authentication_03";
echo  "<link rel='stylesheet' type='text/css' href='fetch_order_details.css'>";
// Establish the database connection
$connection = mysqli_connect($servername, $username, $password, $dbname);

// Check if the connection was successful
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

// Construct the SQL query to fetch all orders
$sql = "SELECT * FROM customers natural join product natural join orders natural join order_items";

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
} else {
    // No orders found
    echo 'No orders found.';
}

// Close the database connection
mysqli_close($connection);
?>