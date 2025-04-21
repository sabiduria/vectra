<?php
require_once 'config.php';
require_once 'functions.php';

header('Content-Type: application/json');

// Get product ID from request
$product_id = isset($_GET['product_id']) ? (int)$_GET['product_id'] : null;
$action = isset($_GET['action']) ? $_GET['action'] : null;

if (!$product_id || !$action) {
    echo json_encode(['error' => 'Missing parameters']);
    exit;
}

try {
    switch ($action) {
        case 'get_sales_data':
            $data = getSalesData($product_id);
            echo json_encode($data);
            break;
            
        case 'get_inventory_metrics':
            $metrics = calculateInventoryMetrics($product_id);
            echo json_encode($metrics);
            break;
            
        case 'get_product_details':
            $details = getProductDetails($product_id);
            echo json_encode($details);
            break;
            
        default:
            echo json_encode(['error' => 'Invalid action']);
    }
} catch (Exception $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>