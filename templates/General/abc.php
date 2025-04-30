<?php
$this->set('title_2', 'Rapport ABC');
?>
<iframe
    src="<?= ($_SERVER['SERVER_NAME'] == 'projects') ? 'http://' . $_SERVER['HTTP_HOST'] . '/php/vectra/webroot/vectra_report/report_abc/index.php' : 'https://' . $_SERVER['HTTP_HOST'] . '/webroot/vectra_report/report_abc/index.php' ?>"
    width="100%"
    height="450px"
    style="border:none;">
</iframe>
