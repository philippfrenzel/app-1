<?php

declare(strict_types=1);

//Assets
use App\Asset\AppAsset;
use Yii\Extension\Fontawesome\Cdn\Css\CdnAllAsset;

//Other
use App\Widget\PerformanceMetrics;
use Yiisoft\I18n\Locale;
use Yiisoft\Form\Widget\Form;
use Yiisoft\Html\Html;
use Yiisoft\Strings\StringHelper;
use Yiisoft\Yii\Bootstrap5\Nav;
use Yiisoft\Yii\Bootstrap5\NavBar;

/**
 * @var \Yiisoft\Router\urlGeneratorInterface $urlGenerator
 * @var \Yiisoft\Router\UrlMatcherInterface $urlMatcher
 * @var \Yiisoft\View\WebView $this
 * @var \Yiisoft\Assets\AssetManager $assetManager
 * @var string $content
 *
 * @see \App\ApplicationViewInjection
 * @var \App\User\User $user
 * @var string $csrf;
 * @var string $brandLabel
 */

$assetManager->register([
    AppAsset::class
    ,CdnAllAsset::class
]);

$this->setCssFiles($assetManager->getCssFiles());
$this->setJsFiles($assetManager->getJsFiles());
$this->setJsStrings($assetManager->getJsStrings());
$this->setJsVar($assetManager->getJsVar());

$currentRoute = $urlMatcher->getCurrentRoute() === null ? '' : $urlMatcher->getCurrentRoute()->getName();

?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Html::encode($locale->language()) ?>">
<head>
    <meta charset="<?= Html::encode($applicationParameters->getCharset()) ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php if ($this->getTitle() !== null): ?>
        <title><?= Html::encode($this->getTitle()) ?></title>
    <?php endif ?>
    <?php $this->head() ?>
</head>
<body>
<?php
$this->beginBody();

echo NavBar::widget()
      ->brandLabel(Html::tag('i','',['class' => 'fas fa-tint']) . ' ' . $brandLabel)
      ->brandUrl($urlGenerator->generate('home'))
      ->options(['class' => 'navbar navbar-light navbar-expand-sm text-black', "style" => "background-color: #81A69E;"])
      ->begin();
echo Nav::widget()
        ->currentPath($currentRoute)
        ->options(['class' => 'navbar-nav mx-auto'])
        ->items(
            [
                //['label' => 'Blog', 'url' => $urlGenerator->generate('blog/index'), 'active' => StringHelper::startsWith($currentRoute, 'blog/') && $currentRoute !== 'blog/comment/index'],
                //['label' => 'Comments Feed', 'url' => $urlGenerator->generate('blog/comment/index')],
                //['label' => 'Users', 'url' => $urlGenerator->generate('user/index'), 'active' => StringHelper::startsWith($currentRoute, 'user/')],
                //['label' => 'Contact', 'url' => $urlGenerator->generate('site/contact')],
                //['label' => 'Swagger', 'url' => $urlGenerator->generate('swagger/index')],
            ]
        );

        echo Nav::widget()
        ->currentPath($urlMatcher->getCurrentUri()->getPath())
        ->options(['class' => 'navbar-nav'])
        ->items(
            $user->getId() === null
                ? [
                [
                    'label' => Html::tag('i','',['class' => 'fas fa-sign-in-alt']) . ' Login'
                    , 'url' => $urlGenerator->generate('login')
                    , 'encode' => false
                ],
                [
                    'label' => Html::tag('i','',['class' => 'fas fa-plus']) . ' Signup'
                    , 'url' => $urlGenerator->generate('register')
                    , 'encode' => false
                ],
            ]
                : [Form::widget()
                    ->action($urlGenerator->generate('logout'))
                    ->options(['csrf' => $csrf])
                    ->begin()
                    . Html::submitButton(' Logout (' . Html::encode($user->getId()) . ')', ['class' => 'dropdown-item fas fa-sign-out-alt'])
                    . Form::end()],
        );
echo NavBar::end();

?><main class="container mt-5 mb-5"><?php
echo $content;
?></main>

<footer class="container-fluid bg-info align-bottom mt-50">
    <?= PerformanceMetrics::widget() ?>
</footer>
<?php

$this->endBody();
?>
</body>
</html>
<?php
$this->endPage(true);