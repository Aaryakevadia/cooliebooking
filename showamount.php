<?php
    if (isset($_POST['show_amount'])) {
        $selected_month = (int)$_POST['month'];
        $coolie_id = (int)$_POST['coolie_id'];
        $conn = new mysqli("localhost", "root", "", "cooliesystem");

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $result = $conn->query("SELECT GetCoolieTotalAmountInMonth($coolie_id, $selected_month) AS total_amount_earned_in_month");

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            echo "<p>Total Amount Earned in " . date("F", mktime(0, 0, 0, $selected_month, 1)) . ": $" . $row['total_amount_earned_in_month'] . "</p>";
        } else {
            echo "<p>No data available for the selected month.</p>";
        }

        $conn->close();
    }
    ?>
