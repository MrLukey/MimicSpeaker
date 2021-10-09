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
?>
<!DOCTYPE html>
<html lang="en-gb">
<head>
    <?php echo PageViewHelper::createHTMLForPageHead() ?>
    <title>Slim ToDo App</title>
</head>
<body>
    <section class="vh-100 d-flex align-items-center justify-content-center">
        <?php
            echo $_SESSION['errorMessage'];
//            echo MimicViewHelper::createHTMLForMimicSpeakerBuilder($processedTexts);
            echo MimicViewHelper::createHTMLForMimicEditor($_SESSION['mimicSpeech'], $processedTexts, $_SESSION['mimicSpeaker']);
        ?>
    </section>
</body>
</html>

<?php
$_SESSION['error'] = false;
$_SESSION['errorMessage'] = '';
