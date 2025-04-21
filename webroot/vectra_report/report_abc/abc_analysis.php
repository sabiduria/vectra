<?php
header('Content-Type: application/json');
require 'config.php'; // Your database connection file

class ABCAnalysis {
    private $pdo;
    
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    
    public function calculateABC($timeRange = '3 MONTH') {
        try {
            // Get sales data for the specified time range
            $query = "
                SELECT 
                    p.id AS product_id,
                    p.name AS product_name,
                    p.reference AS product_reference,
                    SUM(si.qty) AS total_quantity,
                    SUM(si.subtotal) AS total_value,
                    COUNT(DISTINCT s.id) AS order_count
                FROM salesitems si
                JOIN products p ON si.product_id = p.id
                JOIN sales s ON si.sale_id = s.id
                WHERE s.created >= DATE_SUB(NOW(), INTERVAL $timeRange)
                GROUP BY p.id
                ORDER BY total_value DESC
            ";
            
            $stmt = $this->pdo->prepare($query);
            $stmt->execute();
            $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            if (empty($products)) {
                return ['error' => 'No sales data found for the selected period'];
            }
            
            // Calculate cumulative percentages
            $totalValue = array_sum(array_column($products, 'total_value'));
            $cumulativePercentage = 0;
            $abcData = [];
            
            foreach ($products as $index => $product) {
                $percentageOfTotal = ($product['total_value'] / $totalValue) * 100;
                $cumulativePercentage += $percentageOfTotal;
                
                // Determine ABC classification
                if ($cumulativePercentage <= 80) {
                    $class = 'A';
                } elseif ($cumulativePercentage <= 95) {
                    $class = 'B';
                } else {
                    $class = 'C';
                }
                
                $abcData[] = [
                    'product_id' => $product['product_id'],
                    'product_name' => $product['product_name'],
                    'reference' => $product['product_reference'],
                    'total_quantity' => $product['total_quantity'],
                    'total_value' => $product['total_value'],
                    'percentage_of_total' => round($percentageOfTotal, 2),
                    'cumulative_percentage' => round($cumulativePercentage, 2),
                    'class' => $class,
                    'order_count' => $product['order_count'],
                    'turnover_rate' => $product['total_quantity'] > 0 ? 
                        round($product['total_value'] / $product['total_quantity'], 2) : 0
                ];
            }
            
            // Calculate summary statistics
            $summary = $this->calculateSummaryStats($abcData);
            
            return [
                'success' => true,
                'data' => $abcData,
                'summary' => $summary,
                'time_range' => $timeRange
            ];
            
        } catch (PDOException $e) {
            return ['error' => 'Database error: ' . $e->getMessage()];
        }
    }
    
    private function calculateSummaryStats($abcData) {
        $classCounts = ['A' => 0, 'B' => 0, 'C' => 0];
        $classValues = ['A' => 0, 'B' => 0, 'C' => 0];
        $classQuantities = ['A' => 0, 'B' => 0, 'C' => 0];
        
        foreach ($abcData as $item) {
            $classCounts[$item['class']]++;
            $classValues[$item['class']] += $item['total_value'];
            $classQuantities[$item['class']] += $item['total_quantity'];
        }
        
        $totalValue = array_sum($classValues);
        $totalItems = count($abcData);
        
        return [
            'class_counts' => $classCounts,
            'class_percentages' => [
                'A' => round(($classCounts['A'] / $totalItems) * 100, 2),
                'B' => round(($classCounts['B'] / $totalItems) * 100, 2),
                'C' => round(($classCounts['C'] / $totalItems) * 100, 2)
            ],
            'value_distribution' => [
                'A' => round(($classValues['A'] / $totalValue) * 100, 2),
                'B' => round(($classValues['B'] / $totalValue) * 100, 2),
                'C' => round(($classValues['C'] / $totalValue) * 100, 2)
            ],
            'quantity_distribution' => [
                'A' => array_sum($classQuantities) > 0 ? 
                    round(($classQuantities['A'] / array_sum($classQuantities)) * 100, 2) : 0,
                'B' => array_sum($classQuantities) > 0 ? 
                    round(($classQuantities['B'] / array_sum($classQuantities)) * 100, 2) : 0,
                'C' => array_sum($classQuantities) > 0 ? 
                    round(($classQuantities['C'] / array_sum($classQuantities)) * 100, 2) : 0
            ],
            'average_turnover' => [
                'A' => $classCounts['A'] > 0 ? 
                    round(array_sum(array_map(function($item) { 
                        return $item['class'] == 'A' ? $item['turnover_rate'] : 0; 
                    }, $abcData)) / $classCounts['A'], 2) : 0,
                'B' => $classCounts['B'] > 0 ? 
                    round(array_sum(array_map(function($item) { 
                        return $item['class'] == 'B' ? $item['turnover_rate'] : 0; 
                    }, $abcData)) / $classCounts['B'], 2) : 0,
                'C' => $classCounts['C'] > 0 ? 
                    round(array_sum(array_map(function($item) { 
                        return $item['class'] == 'C' ? $item['turnover_rate'] : 0; 
                    }, $abcData)) / $classCounts['C'], 2) : 0
            ]
        ];
    }
}

// Handle API requests
//$pdo = new PDO($dsn, $username, $password); // Initialize your PDO connection
$abcAnalysis = new ABCAnalysis($pdo);

$timeRange = isset($_GET['time_range']) ? $_GET['time_range'] : '3 MONTH';
$response = $abcAnalysis->calculateABC($timeRange);

echo json_encode($response);
?>