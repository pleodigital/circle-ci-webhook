<?php
/**
 * CircleCi Webhook plugin for Craft CMS 3.x
 *
 * Plugin adding CP button triggering CircleCI.
 *
 * @link      https://pleodigital.com/
 * @copyright Copyright (c) 2020 Pleo Digtial
 */

namespace pleodigital\circleciwebhook\models;

use pleodigital\circleciwebhook\CircleciWebhook;

use Craft;
use craft\base\Model;

/**
 * CircleciWebhook Settings Model
 *
 * This is a model used to define the plugin's settings.
 *
 * Models are containers for data. Just about every time information is passed
 * between services, controllers, and templates in Craft, it’s passed via a model.
 *
 * https://craftcms.com/docs/plugins/models
 *
 * @author    Pleo Digtial
 * @package   CircleciWebhook
 * @since     1.0.0
 */
class Settings extends Model
{
    // Public Properties
    // =========================================================================

    /**
     * Some field model attribute
     *
     * @var string
     */
    public $url = '';
    public $params = '';

    // Public Methods
    // =========================================================================

    /**
     * Returns the validation rules for attributes.
     *
     * Validation rules are used by [[validate()]] to check if attribute values are valid.
     * Child classes may override this method to declare different validation rules.
     *
     * More info: http://www.yiiframework.com/doc-2.0/guide-input-validation.html
     *
     * @return array
     */
    public function rules()
    {
        return [
            ['url', 'string'],
            ['url', 'default', 'value' => ''],
            ['params', 'string'],
        ];
    }
}
