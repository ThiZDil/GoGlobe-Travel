<?php
// save_pack_data.php

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Ensure that the pack_id_input is set and not empty
    if (isset($_POST["pack_id_input"]) && !empty($_POST["pack_id_input"])) {
        // Get the sanitized pack_id from the input
        $pack_id = $_POST["pack_id_input"];

        // Connect to your database (replace with your database connection details)
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "goglobetravel";

        // Create a new database connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check if the connection was successful
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Sanitize and validate other input fields
        $title = $_POST["title"]; // Add proper sanitization and validation for other fields as well
        $pack_description = $_POST["pack_description"];
        $programm = $_POST["programm"];
        $grpSize = $_POST["grpSize"];
        $duration_days = $_POST["duration_days"];
        $pack_category = $_POST["pack_category"];
        $regPrice = $_POST["regPrice"];
        $disPrice = $_POST["disPrice"];
        $location = $_POST["location"];
        $active_status = isset($_POST["active_status"]) ? 1 : 0; // Convert checkbox value to 1 or 0

        // Get the old sales price, regular price, and discount from the database
        $old_sales_price = 0;
        $old_reg_price = 0;
        $old_discount = 0;

        $select_old_values_query = "SELECT sale_price, reg_price, discount FROM packages WHERE pack_id=?";
        $stmt_select = $conn->prepare($select_old_values_query);
        $stmt_select->bind_param("i", $pack_id);
        $stmt_select->execute();
        $stmt_select->store_result();
        if ($stmt_select->num_rows > 0) {
            $stmt_select->bind_result($old_sales_price, $old_reg_price, $old_discount);
            $stmt_select->fetch();
        }
        $stmt_select->close();

        // Calculate the new sale price, duration nights, and check if any changes occurred
        $sale_price = $regPrice - ($regPrice * $disPrice) * 0.01;
        $duration_nights = $duration_days - 1;
        $sales_price_changed = ($old_sales_price != $sale_price);
        $reg_price_changed = ($old_reg_price != $regPrice);
        $discount_changed = ($old_discount != $disPrice);

        // Prepare the SQL statement to update the row in the database
        $sql = "UPDATE packages SET title=?, pack_description=?, program=?, grp_size=?, 
                duration_days=?, category=?, reg_price=?, discount=?, location=?, status=?, sale_price=?, duration_nights=?
                WHERE pack_id=?";

        // Prepare the statement
        $stmt = $conn->prepare($sql);

        // Bind the parameters and execute the statement
        $stmt->bind_param(
            "sssiisddsidii", $title, $pack_description, $programm, $grpSize, $duration_days,
            $pack_category, $regPrice, $disPrice, $location, $active_status, $sale_price,
            $duration_nights, $pack_id
        );

        // Execute the statement
        if ($stmt->execute()) {
            // Data updated successfully
            //echo "Data updated successfully!";
            echo "<script>  window.location.href = 'dashboard.php'; </script>";

            // Check if there are any changes in sales price, regular price, or discount
            if ($sales_price_changed || $reg_price_changed || $discount_changed) {
                // If any changes occurred, store the change in the change_pack_price table
                $change_date = date("Y-m-d H:i:s");

                // Prepare the SQL statement to insert the change into the change_pack_price table
                $insert_change_query = "INSERT INTO change_pack_price (pack_id, oldPrice, oldRegPrice, oldDiscount, newPrice, newRegPrice, newDiscount, date) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
                $stmt_insert = $conn->prepare($insert_change_query);

                // Bind the parameters and execute the statement
                $stmt_insert->bind_param(
                    "idddddds", $pack_id, $old_sales_price, $old_reg_price, $old_discount, $sale_price, $regPrice, $disPrice, $change_date
                );
                
                if($stmt_insert->execute()){
                    // Price change data inserted successfully
                    //echo "Price change data inserted successfully!";
                    echo "<script>  window.location.href = 'dashboard.php'; </script>";
                } else {
                    // Handle the error
                    echo "Error inserting price change data: " . $stmt_insert->error;
                }
                $stmt_insert->close();
            }
        } else {
            // Handle the error
            echo "Error updating data: " . $stmt->error;
        }

        // Close the statement and connection
        $stmt->close();
        $conn->close();
    } else {
        // pack_id_input is missing or empty
        echo "Invalid pack ID!";
    }
} else {
    // Handle the case when the form is not submitted directly
    echo "Form submission error!";
}
?>
