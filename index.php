<?php
/**
 * Created by PhpStorm.
 * User: Павел
 * Date: 13.03.2017
 * Time: 14:41
 */

?>
<div>
    <form method="post" action="action.php">
        <label for="url">Укажите сайт</label>
        <input type="text" name="url" id="url"><Br>
        <input type="submit">
    </form>
</div>
<div>
    <?php if (!empty($_POST['url'])) {
        echo run ($_POST['url']);}?>
</div>