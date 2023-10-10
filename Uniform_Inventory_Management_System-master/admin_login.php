<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $admin_username = $_POST["admin_username"];
    $admin_password = $_POST["admin_password"];
    
    // Validate the form data (you can add more validation if required)
    if (empty($admin_username) || empty($admin_password)) {
        $error = "Please fill in all the fields.";
    } else {
        // TODO: Perform login and database operations
        
        // Assuming you have a database table named "users" with columns: id, name, email, password
        $conn = mysqli_connect('localhost', 'root', '','user_authentication_03');
        
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
        
        // Check if the user exists and the entered details are correct
        $query = "SELECT * FROM admin WHERE admin_username='$admin_username' AND admin_password='$admin_password'";
        $result = mysqli_query($conn, $query);
        
        if (mysqli_num_rows($result) == 1) {
            // User exists and details are correct, login successful
            // You can add further code or redirection if needed
            
             mysqli_close($conn);
            // $_SESSION['loggedin']=true;
            // echo "Login Successful";
            $success = "Login successful!";
            header("Location: order_details.html");
            exit();
            
        } else {
            // Invalid login credentials
            header("Location: login.html");
            // echo "Invalid Login Credentials.";
            $error = "Invalid Login Credentials.";
        }
        
        mysqli_close($conn);
    }
}
?>