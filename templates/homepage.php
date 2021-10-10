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
    <?php echo PageViewHelper::createHTMLForPageHead('homePage') ?>
    <title>Mimic Speaker</title>
</head>
<body class="">
    <header class="">
        <?php echo PageViewHelper::createHTMLForNavbar('homepage')?>
    </header>
    <main class="">
        <div class="">
            <div class="mimicEditor d-flex flex-column d-none" data-username="<?php echo $_SESSION['user']->getUserName() ?>" id="mimicEditor">
			    <?php echo MimicViewHelper::createHTMLForMimicEditor($_SESSION['mimicSpeech'], $processedTexts, $_SESSION['mimicSpeaker']); ?>
            </div>
        </div>
        <?php //echo PageViewHelper::(); ?>
    </main>
</body>
</html>

<?php
$_SESSION['error'] = false;
$_SESSION['errorMessage'] = '';
