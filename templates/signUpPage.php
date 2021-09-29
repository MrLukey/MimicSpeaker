<?php

use App\ViewHelpers\PageViewHelper;

?>
<!DOCTYPE html>
<html lang="en-gb">
<head>
    <meta charset="utf-8"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css"
          rel="stylesheet"
          integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU"
          crossorigin="anonymous">
    <link type="text/css" rel="stylesheet" href="/css/loginSignupPageStyles.css">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ"
            crossorigin="anonymous"></script>
    <title>Slim ToDo App Login</title>
</head>
<body>
    <main>
        <?php echo PageViewHelper::createHTMLForSignUpPage() ?>
    </main>
</body>
</html>

<?php

if ($_SESSION['error']){
	$_SESSION['error'] = false;
	$_SESSION['errorMessage'] = '';
}
