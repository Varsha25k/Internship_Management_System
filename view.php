<?php
include 'db.php'; 


if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: index.php");
    exit();
}

$id = $_GET['id'];

$stmt = $conn->prepare("SELECT * FROM interns WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    die("Intern not found!");
}

$row = $result->fetch_assoc();

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Internship Management System | View Intern</title>
  <link rel="stylesheet" href="style.css">
  <style>
    body {
      background: #f4f6f9;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .view-container {
      width: 100%;
      max-width: 550px;
      margin: 40px auto;
      background: #ffffff;
      padding: 35px 45px;
      border-radius: 12px;
      box-shadow: 0 4px 20px rgba(0,0,0,0.1);
      animation: fadeIn 0.8s ease-in-out;
    }

    .view-container h2 {
      text-align: center;
      color: #003366;
      margin-bottom: 25px;
      font-size: 26px;
      text-transform: uppercase;
      border-bottom: 2px solid #003366;
      padding-bottom: 10px;
    }

    .detail-box {
      margin-bottom: 15px;
    }

    .detail-box strong {
      color: #003366;
      display: inline-block;
      width: 150px;
    }

    .view-buttons {
      display: flex;
      justify-content: center;
      gap: 20px;
      margin-top: 25px;
    }

    .view-buttons a {
      padding: 10px 25px;
      border-radius: 6px;
      text-decoration: none;
      color: white;
      font-weight: 500;
      border: none;
      cursor: pointer;
      transition: 0.3s;
    }

    .back-btn {
      background: #6c757d;
    }

    .back-btn:hover {
      background: #5a6268;
    }

    .edit-btn {
      background: #007bff;
    }

    .edit-btn:hover {
      background: #0056b3;
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

  <div class="view-container">
    <h2>Intern Details</h2>

    <div class="detail-box"><strong>Full Name:</strong> <?= htmlspecialchars($row['name']) ?></div>
    <div class="detail-box"><strong>Email:</strong> <?= htmlspecialchars($row['email']) ?></div>
    <div class="detail-box"><strong>University:</strong> <?= htmlspecialchars($row['university']) ?></div>
    <div class="detail-box"><strong>Internship Role:</strong> <?= htmlspecialchars($row['internship_role']) ?></div>
    <div class="detail-box"><strong>Start Date:</strong> <?= htmlspecialchars($row['start_date']) ?></div>
    <div class="detail-box"><strong>End Date:</strong> <?= htmlspecialchars($row['end_date']) ?></div>

    <div class="view-buttons">
      <a href="edit.php?id=<?= htmlspecialchars($row['id']) ?>" class="edit-btn">Edit</a>
      <a href="index.php" class="back-btn">Back</a>
    </div>
  </div>

  <footer>2025 Internship Management System</footer>

</body>
</html>
