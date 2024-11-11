<?php
// Set the content type to JSON
header('Content-Type: application/json');

// Include the connection script
include 'connect.php';

// Check if name is set in the query parameters
if (isset($_GET['name'])) {
    // Get the name from the query parameters
    $name = $_GET['name'];

    // Prepare the SQL query
    $stmt = $conn->prepare("SELECT name, lga, home_town, address, state, status FROM students WHERE name = ?");
    if (!$stmt) {
        echo json_encode(["error" => "Failed to prepare statement: " . $conn->error]);
        exit;
    }

    // Bind parameters
    $stmt->bind_param("s", $name);

    // Execute the query
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if a record was found
    if ($result->num_rows > 0) {
        // Fetch the data and output it as JSON
        $data = $result->fetch_assoc();
        echo json_encode($data);
    } else {
        // If no record is found, return an error message
        echo json_encode(["error" => "No record found for the provided name."]);
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
} else {
    echo json_encode(["error" => "No name provided."]);
}
?>
