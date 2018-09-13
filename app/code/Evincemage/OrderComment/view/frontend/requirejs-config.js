/**
 * @copyright Copyright (c) 2018 www.evincemage.com
 */


var config = {
config: {
    mixins: {
        'Magento_Checkout/js/action/place-order': {
            'Evincemage_OrderComment/js/order/place-order-mixin': true
        },
        'Magento_Checkout/js/action/set-payment-information': {
            'Evincemage_OrderComment/js/order/set-payment-information-mixin': true
        }
    }
}
};