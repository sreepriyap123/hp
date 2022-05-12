define(
    [
        'uiComponent',
        'Magento_Checkout/js/model/payment/renderer-list'
    ],
    function (
        Component,
        rendererList
    ) {
        'use strict';
        rendererList.push(
            {
                type: 'hp_cc',
                component: 'HP_CC/js/view/payment/method-renderer/custompayment'
            }
        );
        return Component.extend({});
    }
);
