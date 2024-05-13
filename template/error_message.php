<?php
include_once '../controller/error_handler.php';
$error_message = get_error_message();
if ($error_message) :
?>
     <p class="text-red-600"><?= $error_message ?></p>
<?php endif; ?>