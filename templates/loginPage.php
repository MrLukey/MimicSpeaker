<?php

use App\ViewHelpers\PageViewHelper;

?>

<!DOCTYPE html>
<html lang="en-gb">
<head>
    <?php echo PageViewHelper::createHTMLForPageHead('loginPage') ?>
    <title>Mimic Speaker Login</title>
</head>
<body>
    <header>
        <?php echo PageViewHelper::createHTMLForNavbar() ?>
    </header>
    <main>
        <?php echo PageViewHelper::createHTMLForLoginPage() ?>
    </main>
</body>
</html>

<?php
$_SESSION['error'] = false;
$_SESSION['errorMessage'] = '';
