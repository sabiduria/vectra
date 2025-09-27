<?php
/**
 * Minimal PDF layout for CakePHP and Dompdf
 *
 * Place this file in: templates/layout/pdf.php
 */
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title><?= $this->fetch('title') ?></title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; color: #333; margin: 0; padding: 20px; }
        h4, h5, h6 { margin: 0; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f5f5f5; }
        .text-right { text-align: right; }
        .text-center { text-align: center; }
        .fw-bold { font-weight: bold; }
        .invoice-header { margin-bottom: 20px; }
        .invoice-footer { margin-top: 50px; }
        .signature { border-bottom: 1px solid #000; width: 200px; height: 50px; display: inline-block; }
        .logo { height: 60px; margin-right: 15px; }
        p { margin: 2px 0; }
    </style>
</head>
<body>
<?= $this->fetch('content') ?>
</body>
</html>
