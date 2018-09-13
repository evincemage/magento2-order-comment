/**
 * @copyright Copyright (c) 2018 www.evincemage.com
 */
define([
    'jquery',
    'mage/utils/wrapper',
    'Evincemage_OrderComment/js/order/ordercomment-assigner'
], function ($, wrapper, ordercommentAssigner) {
    'use strict';

    return function (placeOrderAction) {

        /** Override default place order action and add comments to request */
        return wrapper.wrap(placeOrderAction, function (originalAction, paymentData, messageContainer) {
            ordercommentAssigner(paymentData);

            return originalAction(paymentData, messageContainer);
        });
    };
});