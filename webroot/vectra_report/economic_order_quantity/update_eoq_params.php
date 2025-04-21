<?php
// Database connection
$pdo = new PDO('mysql:host=localhost;dbname=vectra', 'root', '');

// Fetch products
$products = $pdo->query("SELECT id, name FROM products")->fetchAll();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare("
        UPDATE products 
        SET 
            annual_demand = ?, 
            ordering_cost = ?, 
            holding_cost = ?, 
            lead_time_days = ? 
        WHERE id = ?
    ");
    $stmt->execute([
        $_POST['annual_demand'],
        $_POST['ordering_cost'],
        $_POST['holding_cost'],
        $_POST['lead_time_days'],
        $_POST['product_id']
    ]);
    echo "<p>EOQ parameters updated!</p>";
}
?>

<form method="POST">
    <label>Product:
        <select name="product_id">
            <?php foreach ($products as $p): ?>
                <option value="<?= $p['id'] ?>"><?= $p['name'] ?></option>
            <?php endforeach; ?>
        </select>
    </label><br>
    <label>Annual Demand: <input type="number" name="annual_demand" required></label><br>
    <label>Ordering Cost ($): <input type="number" step="0.01" name="ordering_cost" required></label><br>
    <label>Holding Cost ($/unit/year): <input type="number" step="0.01" name="holding_cost" required></label><br>
    <label>Lead Time (days): <input type="number" name="lead_time_days" required></label><br>
    <button type="submit">Update</button>
</form>