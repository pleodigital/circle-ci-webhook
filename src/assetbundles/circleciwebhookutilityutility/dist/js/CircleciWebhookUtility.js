/**
 * CircleCi Webhook plugin for Craft CMS
 *
 * CircleciWebhookUtility Utility JS
 *
 * @author    Pleo Digtial
 * @copyright Copyright (c) 2020 Pleo Digtial
 * @link      https://pleodigital.com/
 * @package   CircleciWebhook
 * @since     1.0.0
 */

!function ($) {
    var deployButtons = $('#content .circle-ci-deploy-wrapper button');
    if (deployButtons) {
        deployButtons.on('click', function () {
            var _this = this
            $(_this).addClass('add loading');
            $(_this).removeClass('submit');
            $(_this).prop('disabled', true); 
            var data = {};
            data[window.Craft.csrfTokenName] = window.Craft.csrfTokenValue; // Append CSRF Token
            $.ajax({
                type: "POST",
                url: $(_this).attr('data-action-url'), 
                data: data,  
                error: function () {
                    $(_this).removeClass('add loading');
                    $(_this).addClass('submit');
                    $(_this).prop('disabled', false);
                },
                success: function () {
                    $(_this).removeClass('add loading');
                }
            });
        });
    }
}(jQuery);