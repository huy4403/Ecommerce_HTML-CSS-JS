<?php
include("../database/connect.php");
include("../database/session.php");

// SQL query to delete the cart
$deleteCartQuery = "DELETE FROM cart WHERE id_user = ? and id = ?";

// Use a prepared statement to prevent SQL injection
if ($deleteStmt = $conn->prepare($deleteCartQuery)) {
    $deleteStmt->bind_param("ii", $_SESSION['id'], $_SESSION['id_cart']);
    // Execute the query
    if ($deleteStmt->execute()) {
        unset($_SESSION['id_cart']);
        $deleteStmt->close(); // Close the statement

        // Provide a message indicating successful deletion
    } else {
        echo "Xóa cart thất bại";
    }
} else {
    echo "Không tìm thấy cart để xóa";
}

// Close the database connection
$conn->close();
