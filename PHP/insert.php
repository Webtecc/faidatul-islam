<?php
// Include the database connection script
include_once('connect.php');

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Retrieve form data
    $name = $_POST['name'];
    $parent_guardian_name = $_POST['parent_guardian_name'];
    $parent_guardian_contact = $_POST['parent_guardian_contact'];
    $address = $_POST['address'];
    $gender = $_POST['gender'];
    $state = $_POST['state'];
    $lga = $_POST['lga'];
    $home_town = $_POST['home_town'];

    // Prepare the SQL INSERT query with placeholders
    $stmt = $conn->prepare("INSERT INTO students (
        name, parent_guardian_name, parent_guardian_contact, address, gender, state, lga, home_town
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

    // Bind parameters
    $stmt->bind_param("ssssssss", $name, $parent_guardian_name, $parent_guardian_contact, $address, $gender, $state, $lga, $home_town);

    // Execute the query and check if it was successful
    if ($stmt->execute()) {
        echo '';
    } else {
        echo '' . $stmt->error;
    }

    // Close the statement
    $stmt->close();
}
?>
