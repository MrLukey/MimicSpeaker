<?php
print_r($data);
?>
<!DOCTYPE html>
<html lang="en-gb">
<head>
    <meta charset="utf-8"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css"
          rel="stylesheet"
          integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU"
          crossorigin="anonymous">
    <link type="text/css" rel="stylesheet" href="/css/taskStyling.css">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ"
            crossorigin="anonymous"></script>
    <title>Slim ToDo App Login</title>
</head>
<body>
    <main>
        <div class="w-100 mt-5 mb-5">
            <form method="post">
                <div class="input-group">
                    <label class="input-group-text" for="userName">Username:</label>
                    <input type="text" maxlength="100" class="form-control" name="userName" id="userName" placeholder="e.g Walk the dog">
                </div>
                <div class="input-group">
                    <label class="input-group-text" for="rawPassword">Password:</label>
                    <input type="password" maxlength="100" class="form-control" name="rawPassword" id="rawPassword" placeholder="e.g Walk the dog">
                </div>
                <input type="submit" value="Login" formaction="login">
                <input type="submit" value="Sign Up" formaction="signUp">
            </form>
        </div>
    </main>
</body>
</html>
