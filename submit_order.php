<?php
// Establish a database connection (replace the placeholders with your actual database credentials)
$hostname = "localhost";
$username = "root";
$password = "";
$dbname = "user_authentication_03";

// Create database
$database = 'user_authentication_03';
$conn = mysqli_connect($hostname, $username, $password);
$sql = "CREATE DATABASE IF NOT EXISTS $database";
if (mysqli_query($conn, $sql)) {
    echo "Database created successfully.";
} else {
    echo "Error creating database: " . mysqli_error($conn);
}
mysqli_close($conn);

// Create a new connection
$conn = new mysqli($hostname, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Retrieve form data
    $Customer_Name = $_POST["Customer_Name"];
    $Customer_Email = $_POST["Customer_Email"];
    $Delivery_Address = $_POST["Delivery_Address"];
    $Product_type = $_POST["Product_type"];
    $Size_value = $_POST["Size"];
    $colorValue = $_POST["Color"];
    $Quantity = $_POST["Quantity"];

    //Map the selected value to its actual size
    $sizeOptions = array(
        "1" => "20",
        "2" => "22",
        "3" => "24",
        "4" => "26",
        "5" => "28",
        "6" => "30",
        "7" => "32",
        "8" => "34",
        "9" => "36",
        "10" => "38",
        "11" => "40",
        "12" => "42",
        "13" => "44",
        "14" => "46",
        "15" => "48"
    );
    $size = $sizeOptions[$Size_value];


    //MAp the selected value of its actaul color
    $colorOptions = array(
        "1" => "Red",
        "2" => "R.blue",
        "3" => "P Green",
        "4" => "C Green",
        "5" => "N Blue",
        "6" => "Parrot Green",
        "7" => "Black",
        "9" => "Gold",
        "10" => "Lemon",
        "11" => "Mango Gold",
        "12" => "White",
        "13" => "Gray",
        "14" => "Gray Milange",
        "15" => "Antra Milange",
        "16" => "Light Blue",
        "17" => "Charcol Grey",
        "18" => "Lavender",
        "19" => "Wine",
        "20" => "Maroon"
    );
    $color = $colorOptions[$colorValue];

    // Insert the form data into appropriate database tables
    $conn = mysqli_connect('localhost', 'root', '','user_authentication_03'); 
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    session_start();
    $user_id = implode(" ",$_SESSION['get_user_id']);
    // echo "$user_id";
    // Insert into the Customers table
     // Insert into the Customers table
    //  $customerQuery = "INSERT INTO customers (user_id , Customer_Name, Customer_Email, Delivery_Address) VALUES ('$user_id','$Customer_Name', '$Customer_Email', '$Delivery_Address')";
    //  if (mysqli_query($conn, $customerQuery)) {
    //      $Customer_id = mysqli_insert_id($conn); // Get the ID of the newly inserted customer
    //  } else {
    //      echo "Error inserting into Customers table: " . mysqli_error($conn);
    //  }

    if(mysqli_num_rows(mysqli_query($conn,"SELECT * FROM customers WHERE Customer_Name = '$Customer_Name' AND Customer_Email = '$Customer_Email'"))==0)
    {   //New Customer
        $customerQuery = "INSERT INTO customers (User_id, Customer_Name, Customer_Email, Delivery_Address) 
            VALUES ('$user_id','$Customer_Name', '$Customer_Email', '$Delivery_Address')";
        if (mysqli_query($conn, $customerQuery)) {
            $Customer_id = mysqli_insert_id($conn); // Get the ID of the newly inserted customer
        }
        else {
            echo "Error inserting into Customers table: " . mysqli_error($conn);
        }
    }
    else
    {   // Old Customer
        $Customer_id=implode(" ",mysqli_fetch_assoc(mysqli_query($conn,"SELECT Customer_id FROM customers WHERE Customer_Email = '$Customer_Email'")));
    }
    $sql = "INSERT INTO product ( Product_type) VALUES (  '$Product_type')";
    if ($conn->query($sql) === TRUE) {
        $Product_id = $conn->insert_id; // Get the ID of the newly inserted order
    } else {
        echo "Error inserting into Orders table: " . $conn->error;
    }

     $sql = "INSERT INTO orders ( Customer_id,Product_id) VALUES (  '$Customer_id','$Product_id')";
    if ($conn->query($sql) === TRUE) {
        $Order_id = $conn->insert_id; // Get the ID of the newly inserted order
    } else {
        echo "Error inserting into Orders table: " . $conn->error;
    }
    
    // Insert into the Orders table
    $sql = "INSERT INTO order_items (Order_id, Color,Size, Quantity) VALUES ( '$Order_id','$color', '$size', '$Quantity')";
    if ($conn->query($sql) === TRUE) {
        $Order_items_id = $conn->insert_id; // Get the ID of the newly inserted order
    } else {
        echo "Error inserting into Orders table: " . $conn->error;
    }
    
    // if (mysqli_query($conn, $sql)) {
    //     // Order details inserted successfully
        
    //     // Send email confirmation to the user
    //     $to = "$Customer_Email"; // Replace with the user's email address
    //     $subject = "Order Confirmation";
    //     $message = "Dear $Customer_Name,\n\nYour order for $Quantity $Product_type has been successfully registered.\n\nThank you for your order!";
    //     $headers = "From: .com"; // Replace with your email address
        
    //     // Use the mail() function to send the email
    //     mail($to, $subject, $message, $headers);
        
    //     // // Redirect the user to a success page or display a success message
    //     // header("Location: success.php");
    //     // exit();
    // }

    // Display success message
    echo "Order submitted successfully!";
}

// Close the database connection
$conn->close();
?>
