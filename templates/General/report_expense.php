<?php
$this->set('title_2', 'Rapport Dépenses');
$this->set('menu_reports', 'active open');
?>
<iframe
    src="<?= ($_SERVER['SERVER_NAME'] == 'projects') ? 'http://' . $_SERVER['HTTP_HOST'] . '/php/vectra/webroot/vectra_report/expense_stats/index.php' : 'https://' . $_SERVER['HTTP_HOST'] . '/webroot/vectra_report/expense_stats/index.php' ?>"
    width="100%"
    height="450px"
    style="border:none;">
</iframe>
