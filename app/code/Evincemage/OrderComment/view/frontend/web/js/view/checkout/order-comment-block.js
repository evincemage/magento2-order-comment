/**
 * @copyright Copyright (c) 2018 www.evincemage.com
 */
define(
    [
        'jquery',
		'ko',
        'uiComponent'
    ],
    function ($, ko, Component) {
        'use strict';
		var show_comment_blockConfig = window.checkoutConfig.show_comment_block;
        return Component.extend({
            defaults: {
                template: 'Evincemage_OrderComment/checkout/order-comment-block'
            },
			canVisibleBlock: show_comment_blockConfig
        });
    }
);
