<?php
/**
 * CircleCi Webhook plugin for Craft CMS 3.x
 *
 * Plugin adding CP button triggering CircleCI.
 *
 * @link      https://pleodigital.com/
 * @copyright Copyright (c) 2020 Pleo Digtial
 */

namespace pleodigital\circleciwebhook\controllers;

use pleodigital\circleciwebhook\CircleciWebhook;

use Craft;
use craft\web\Controller;

/**
 * Default Controller
 *
 * Generally speaking, controllers are the middlemen between the front end of
 * the CP/website and your plugin’s services. They contain action methods which
 * handle individual tasks.
 *
 * A common pattern used throughout Craft involves a controller action gathering
 * post data, saving it on a model, passing the model off to a service, and then
 * responding to the request appropriately depending on the service method’s response.
 *
 * Action methods begin with the prefix “action”, followed by a description of what
 * the method does (for example, actionSaveIngredient()).
 *
 * https://craftcms.com/docs/plugins/controllers
 *
 * @author    Pleo Digtial
 * @package   CircleciWebhook
 * @since     1.0.0
 */
class DefaultController extends Controller
{

    // Protected Properties
    // =========================================================================

    /**
     * @var    bool|array Allows anonymous access to this controller's actions.
     *         The actions must be in 'kebab-case'
     * @access protected
     */
    protected array|bool|int $allowAnonymous = [];

    // Public Methods
    // =========================================================================

    /**
     * Handle a request going to our plugin's index action URL,
     * e.g.: actions/circle-ci-webhook/default
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $url = Craft :: $app -> plugins -> getPlugin('circle-ci-webhook') -> getSettings() -> url;
        $params = Craft :: $app -> plugins -> getPlugin('circle-ci-webhook') -> getSettings() -> params;
        
        $paramsJson = json_decode($params); 

        $resCurl = curl_init($url);
        curl_setopt($resCurl, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json'
        ));
        curl_setopt($resCurl, CURLOPT_HEADER, true);
        curl_setopt($resCurl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($resCurl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($resCurl, CURLOPT_POST, true );
        curl_setopt($resCurl, CURLOPT_POSTFIELDS, json_encode($paramsJson));
        
        $rawResponse = curl_exec($resCurl);
        $httpCode = curl_getinfo($resCurl, CURLINFO_HTTP_CODE);
        
        if($httpCode > 199 && $httpCode < 300) {
            return $rawResponse;
        } else {
            throw new Exception($rawResponse);
        }
    }
}
