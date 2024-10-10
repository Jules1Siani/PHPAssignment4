<?php
// Include database connection
require('../model/database.php');

// Switch based on request method
switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        // Check if productCode is passed as a query parameter
        if (isset($_GET['productCode'])) {
            $productCode = $_GET['productCode'];

            // Prepare and execute the deletion query
            $sql = "DELETE FROM products WHERE productCode = :productCode";
            $statement = $db->prepare($sql);
            $statement->bindValue(':productCode', $productCode, PDO::PARAM_STR);

            if ($statement->execute()) {
                // Redirect to the product list page after successful deletion
                header('Location: view_product.php?success=Product deleted successfully');
                exit();
            } else {
                // Handle error if deletion fails
                echo "Error deleting product.";
            }
        } else {
            // If no productCode is passed, redirect to the product list
            header('Location: view_product.php?error=No product code provided');
            exit();
        }
        break;

    default:
        // For other request methods, do nothing or show a default message
        echo "Invalid request method.";
        break;
}
?>

