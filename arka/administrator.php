<?php


// Set the page title and include the HTML header.
$page_title = 'Login for supplier ';

require_once('mysqli.php'); // Connect to the db.

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the form has been submitted for login
    if (!empty($_POST['email']) && isset($_POST['password'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Check if the input matches the administrator credentials
        $admin_email = "admin@gmail.com";
        $admin_password = "admin123"; // Set the administrator password

        if ($email == $admin_email && $password == $admin_password) {
            // Administrator login successful, redirect to order list
            header("Location: order list.php");
            exit();
        } else {
            // Invalid login credentials
            echo "<p style='color:red;'>Invalid email or password</p>";
        }
    }
}
?>
<head>
    <meta charset="UTF-8">
    <title>Login for Supplier</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
            color: #333;
            text-align: center;
        }

        #login-container {
            width: 300px;
            margin: 100px auto;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            padding: 20px;
        }

        h1 {
            color: #3498db;
        }

        form {
            margin-top: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #333;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: #fff;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        p {
            margin-top: 20px;
            color: #333;
        }

        a.button {
            display: inline-block;
            padding: 10px 20px;
            text-decoration: none;
            background-color: #3498db;
            color: #fff;
            border: 1px solid #3498db;
            border-radius: 5px;
            margin-top: 10px;
        }

        a.button:hover {
            background-color: #2573af;
            border-color: #2573af;
        }
    </style>
</head>
<body>

    <div id="login-container">
        <h1>Login for Administrator</h1>
        
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label for="email">Email:</label>
            <input type="text" name="email" required><br>
            
            <label for="password">Your Password:</label>
            <input type="password" name="password" required><br>
            
            <input type="submit" value="Login">
            <a href="homepage.html" class="button">Go to Homepage</a>
        </form>

        
    </div>

</body>