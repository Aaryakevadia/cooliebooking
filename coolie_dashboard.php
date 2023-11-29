<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coolie Dashboard</title>
    <link rel="stylesheet" type="text/css" href="coolie_dashboard.css">
</head>
<body>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cooliesystem";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get coolie input
    $coolie_id = $_POST["coolie_id"];
    $password = $_POST["password"];

    // Fetch coolie data from the database
    $sql = "SELECT * FROM coolies WHERE coolie_id = '$coolie_id' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        ?>

        <div class="coolie-details-container">
            <h1>Coolie Dashboard</h1>
            <div class="coolie-details">
                <h2>Coolie ID: <?php echo $row["coolie_id"]; ?></h2>
                <p>Name: <?php echo $row["first_name"] . " " . $row["last_name"]; ?></p>
                <p>Gender: <?php echo $row["gender"]; ?></p>
                <p>Age: <?php echo $row["age"]; ?></p>
                <p>Phone Number: <?php echo $row["phone_number"]; ?></p>
                <!-- Add more details as needed -->

                <!-- Coolie ID and Show Amount form -->
                <form method="post" action="showamount.php">
                    <label for="coolie_id">Coolie ID:</label>
                    <input type="text" name="coolie_id" required>
                    <label for="month">Select Month:</label>
                    <select name="month" id="month" required>
                        <option value="1">January</option>
                        <option value="2">February</option>
                        <option value="3">March</option>
                        <option value="4">April</option>
                        <option value="5">May</option>
                        <option value="6">June</option>
                        <option value="7">July</option>
                        <option value="8">August</option>
                        <option value="9">September</option>
                        <option value="10">October</option>
                        <option value="11">November</option>
                        <option value="12">December</option>
                    </select>
                    <button type="submit" name="show_amount">Show Amount</button>
                </form>
            </div>
        </div>

        <?php
    } else {
        echo "Coolie not found with the provided credentials.";
    }
}

$conn->close();
?>

</body>
</html>
