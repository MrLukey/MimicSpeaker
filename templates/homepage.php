<?php
use App\ViewHelpers\MimicViewHelper;
use App\ViewHelpers\PageViewHelper;
if (!$_SESSION['error'] && $data === []){
	$_SESSION['errorMessage'] = 'There are no mimics in the database.';
	$mimics = [];
	$processedTexts = [];
} else {
    $mimics = $data['mimics'];
    $processedTexts = $data['processedTexts'];
}

if ($_SESSION['user'] !== null){
	$username = $_SESSION['user']->getUserName();
} else {
	$username = 'Guest';
}
//$_SESSION['mimicSpeaker'] = null;
//$_SESSION['mimicSpeech'] = [];
//$_SESSION['user'] = null;
//print_r($_SESSION['user']);
?>
<!DOCTYPE html>
<html lang="en-gb">
<head>
    <?php echo PageViewHelper::createHTMLForPageHead() ?>
    <title>Mimic Speaker</title>
</head>
<body>
    <button class="btn btn-lg btn-success" id="openCreatorButton">Create Mimic</button>
    <div class="mimicEditor d-flex flex-column" data-username="<?php echo $username ?>" id="mimicEditor">
        <?php echo MimicViewHelper::createHTMLForMimicEditor($_SESSION['mimicSpeech'], $processedTexts, $_SESSION['mimicSpeaker']); ?>
    </div>
</body>
</html>

<?php
$_SESSION['error'] = false;
$_SESSION['errorMessage'] = '';
