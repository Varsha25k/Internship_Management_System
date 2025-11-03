<?php
include 'db.php'; 

$search = "";
if (isset($_GET['query'])) {
    $search = $_GET['query'];
    $sql = "SELECT * FROM interns 
            WHERE name LIKE '%$search%' 
               OR university LIKE '%$search%' 
               OR internship_role LIKE '%$search%'";
} else {
    $sql = "SELECT * FROM interns";
}

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Internship Management System | Dashboard</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

    <h2>Internship Management System</h2>
    <div class="container">

        <!-- Search Box -->
        <div class="search-box">
            <form method="GET" action="">
                <input type="text" name="query" placeholder="Search by name, university, or role" value="<?php echo htmlspecialchars($search); ?>">
                <input type="submit" value="Search">
            </form>
        </div>

        <!-- Add New Intern -->
        <a href="add.php" class="btn add-btn">+ Add New Intern</a>

        <!-- Interns Table -->
        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Role</th>
                <th>Actions</th>
            </tr>

            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>
                        <td>" . htmlspecialchars($row['id']) . "</td>
                        <td>" . htmlspecialchars($row['name']) . "</td>
                        <td>" . htmlspecialchars($row['internship_role']) . "</td>
                        <td>
                            <a href='view.php?id=" . htmlspecialchars($row['id']) . "' class='btn view-btn'>View</a>
                            <a href='edit.php?id=" . htmlspecialchars($row['id']) . "' class='btn edit-btn'>Edit</a>
                            <a href='delete.php?id=" . htmlspecialchars($row['id']) . "' class='btn delete-btn' onclick='return confirm(\"Are you sure you want to delete this intern?\")'>Delete</a>
                        </td>
                    </tr>";
                }
            } else {
                echo "<tr><td colspan='4'>No interns found.</td></tr>";
            }
            ?>
        </table>
    </div>

</body>
</html>
