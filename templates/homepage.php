<?php
use App\ViewHelpers\MimicViewHelper;
use App\ViewHelpers\PageViewHelper;
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
    <section class="">
        <div class="">
            <div class="mimicEditor d-flex flex-column d-none" data-username="<?php echo $_SESSION['user']->getUserName() ?>" id="mimicEditor">
			    <?php echo MimicViewHelper::createHTMLForMimicEditor($_SESSION['mimicSpeech'], $data['processedTexts'], $_SESSION['mimicSpeaker']); ?>
            </div>
        </div>
        <?php //echo PageViewHelper::(); ?>
    </section>
    <?php
    echo MimicViewHelper::createHTMLForMimicAlbum($data['mimics'])
    //echo MimicViewHelper::createHTMLForPublishConfirmation();
    ?>
</body>
</html>

<?php
$_SESSION['error'] = false;
$_SESSION['errorMessage'] = '';
