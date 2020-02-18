<?php
/**
 * CircleCi Webhook plugin for Craft CMS 3.x
 *
 * Plugin adding CP button triggering CircleCI.
 *
 * @link      https://pleodigital.com/
 * @copyright Copyright (c) 2020 Pleo Digtial
 */

namespace pleodigital\circleciwebhook\utilities;

use pleodigital\circleciwebhook\CircleciWebhook;
use pleodigital\circleciwebhook\assetbundles\circleciwebhookutilityutility\CircleciWebhookUtilityUtilityAsset;

use Craft;
use craft\base\Utility;

/**
 * CircleCi Webhook Utility
 *
 * Utility is the base class for classes representing Control Panel utilities.
 *
 * https://craftcms.com/docs/plugins/utilities
 *
 * @author    Pleo Digtial
 * @package   CircleciWebhook
 * @since     1.0.0
 */
class CircleciWebhookUtility extends Utility
{
    // Static
    // =========================================================================

    /**
     * Returns the display name of this utility.
     *
     * @return string The display name of this utility.
     */
    public static function displayName(): string
    {
        return Craft::t('circle-ci-webhook', 'CircleciWebhookUtility');
    }

    /**
     * Returns the utility’s unique identifier.
     *
     * The ID should be in `kebab-case`, as it will be visible in the URL (`admin/utilities/the-handle`).
     *
     * @return string
     */
    public static function id(): string
    {
        return 'circleciwebhook-circleci-webhook-utility';
    }

    /**
     * Returns the path to the utility's SVG icon.
     *
     * @return string|null The path to the utility SVG icon
     */
    public static function iconPath()
    {
        return Craft::getAlias("@pleodigital/circleciwebhook/assetbundles/circleciwebhookutilityutility/dist/img/CircleciWebhookUtility-icon.svg");
    }

    /**
     * Returns the number that should be shown in the utility’s nav item badge.
     *
     * If `0` is returned, no badge will be shown
     *
     * @return int
     */
    public static function badgeCount(): int
    {
        return 0;
    }

    /**
     * Returns the utility's content HTML.
     *
     * @return string
     */
    public static function contentHtml(): string
    {
        Craft::$app->getView()->registerAssetBundle(CircleciWebhookUtilityUtilityAsset::class);
        $url = Craft :: $app -> plugins -> getPlugin('circle-ci-webhook') -> getSettings() -> url;
        $params = Craft :: $app -> plugins -> getPlugin('circle-ci-webhook') -> getSettings() -> params;

        return Craft::$app->getView()->renderTemplate(
            'circle-ci-webhook/_components/utilities/CircleciWebhookUtility_content', [
                'url' => $url,
                'params' => $params
        ]);
    }
}
