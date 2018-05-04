<?php

use app\core\View;

if (empty($_SESSION['authorize'])){
    sleep(3);
    View::redirect('/');
}
?>
<h2>Error page 403</h2>
<p>Нет прав.</p>
