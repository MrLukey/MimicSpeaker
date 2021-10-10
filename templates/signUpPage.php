<?php

use App\ViewHelpers\PageViewHelper;

?>
<!DOCTYPE html>
<html lang="en-gb">
<head>
    <?php echo PageViewHelper::createHTMLForPageHead('signUpPage')?>
    <title>Slim ToDo App Login</title>
</head>
<body>
    <header>
        <?php echo PageViewHelper::createHTMLForNavbar() ?>
    </header>
    <main>
        <?php echo PageViewHelper::createHTMLForSignUpPage() ?>
    </main>
</body>
</html>

<?php
$_SESSION['error'] = false;
$_SESSION['errorMessage'] = '';
