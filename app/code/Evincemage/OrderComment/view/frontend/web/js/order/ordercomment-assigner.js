/**
 * @copyright Copyright (c) 2018 www.evincemage.com
 */
define([
    'jquery'
], function ($) {
    'use strict';


    /** Override default place order action and add comment to request */
    return function (paymentData) {

        if (paymentData['extension_attributes'] === undefined) {
            paymentData['extension_attributes'] = {};
        }

        paymentData['extension_attributes']['comment'] = jQuery('[name="em_order_comment"]').val();
    };
});