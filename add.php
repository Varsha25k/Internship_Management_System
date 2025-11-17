<?php
include 'db.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $university = $_POST['university'];
    $internship_role = $_POST['internship_role'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];

    $stmt = $conn->prepare("INSERT INTO interns (name, email, university, internship_role, start_date, end_date) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $name, $email, $university, $internship_role, $start_date, $end_date);

    if ($stmt->execute()) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Internship Management System | Add Intern</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <style>

        body {
            background: #f4f6f9;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .form-container {
            width: 100%;
            max-width: 550px;
            margin: 40px auto;
            background: #ffffff;
            padding: 35px 45px;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
            animation: fadeIn 0.8s ease-in-out;
        }

        .form-container h2 {
            text-align: center;
            color: #003366;
            margin-bottom: 25px;
            font-size: 26px;
            text-transform: uppercase;
            border-bottom: 2px solid #003366;
            padding-bottom: 10px;
        }

        .form-container label {
            display: block;
            margin-top: 15px;
            font-weight: 500;
            color: #333;
        }

        .form-container input[type="text"],
        .form-container input[type="email"],
        .form-container input[type="date"] {
            width: 100%;
            padding: 10px;
            margin-top: 6px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .form-container input:focus {
            border-color: #007bff;
            box-shadow: 0 0 4px rgba(0,123,255,0.4);
        }

        .form-buttons {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 25px;
        }

        .form-buttons input[type="submit"],
        .form-buttons a {
            padding: 10px 25px;
            border-radius: 6px;
            text-decoration: none;
            color: white;
            font-weight: 500;
            border: none;
            cursor: pointer;
            transition: 0.3s;
        }

        .form-buttons input[type="submit"] {
            background: #28a745;
        }

        .form-buttons input[type="submit"]:hover {
            background: #218838;
        }

        .form-buttons a {
            background: #6c757d;
        }

        .form-buttons a:hover {
            background: #5a6268;
        }

        footer {
            text-align: center;
            margin: 30px 0 10px 0;
            color: #777;
            font-size: 14px;
        }

        @keyframes fadeIn {
            from {opacity: 0; transform: translateY(-10px);}
            to {opacity: 1; transform: translateY(0);}
        }
    </style>
</head>
<body>
     
    <a href="index.php" class="back-link">← Back to Dashboard</a>
    <div class="form-container">
        <h2>Add New Intern</h2>

        <form method="POST" action="">
            <label for="name">Full Name:</label>
            <input type="text" name="name" id="name" placeholder="Enter full name" required>

            <label for="email">Email:</label>
            <input type="email" name="email" id="email" placeholder="Enter email" required>

            <label for="university">University:</label>
            <input type="text" name="university" id="university" placeholder="Enter university name" required>

            <label for="role">Internship Role:</label>
            <input type="text" name="internship_role" id="role" placeholder="Enter internship role" required>

            <label for="start_date">Start Date:</label>
            <input type="date" name="start_date" id="start_date" required>

            <label for="end_date">End Date:</label>
            <input type="date" name="end_date" id="end_date" required>

            <div class="form-buttons">
                <input type="submit" value="Add Intern">
                <a href="index.php">Cancel</a>
            </div>
        </form>
    </div>

    <footer>
         2025 Internship Management System
    </footer>

</body>
</html>
