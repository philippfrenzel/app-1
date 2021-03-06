<?php

declare(strict_types=1);

namespace App\ViewInjection;

use App\ApplicationParameters;
use Yiisoft\Assets\AssetManager;
use Yiisoft\I18n\Locale;
use Yiisoft\Router\UrlGeneratorInterface;
use Yiisoft\Router\UrlMatcherInterface;
use Yiisoft\Yii\View\LayoutParametersInjectionInterface;
//use Yiisoft\User\CurrentUser;
use Yii\Extension\User\ActiveRecord\User as CurrentUser;

final class LayoutViewInjection implements LayoutParametersInjectionInterface
{
    private ApplicationParameters $applicationParameters;
    private AssetManager $assetManager;
    private Locale $locale;
    private UrlGeneratorInterface $urlGenerator;
    private UrlMatcherInterface $urlMatcher;
    private CurrentUser $currentUser;

    public function __construct(
        ApplicationParameters $applicationParameters,
        AssetManager $assetManager,
        Locale $locale,
        UrlGeneratorInterface $urlGenerator,
        UrlMatcherInterface $urlMatcher,
        CurrentUser $currentUser
    ) {
        $this->applicationParameters = $applicationParameters;
        $this->assetManager = $assetManager;
        $this->locale = $locale;
        $this->urlGenerator = $urlGenerator;
        $this->urlMatcher = $urlMatcher;
        $this->currentUser = $currentUser;
    }

    public function getLayoutParameters(): array
    {
        return [
            'applicationParameters' => $this->applicationParameters,
            'brandLabel' => 'Tropfen',
            'assetManager' => $this->assetManager,
            'user' => $this->currentUser, //->getIdentity(),
            'locale' => $this->locale,
            'urlGenerator' => $this->urlGenerator,
            'urlMatcher' => $this->urlMatcher,
        ];
    }
}
