/*
 * Copyright © Reach Digital (https://www.reachdigital.io/)
 * See LICENSE.txt for license details.
 */

define([
    'jquery',
    'mage/utils/wrapper',
    'Magento_Checkout/js/model/quote'
], function ($, wrapper, quote) {
    'use strict';

    return function (setShippingInformationAction) {
        return wrapper.wrap(setShippingInformationAction, function (originalAction) {
            var shippingAddress = quote.shippingAddress();

            if (shippingAddress.customAttributes === undefined) {
                // pass execution to original action ('Magento_Checkout/js/action/set-shipping-information')
                return originalAction();
            }

            if (shippingAddress['extension_attributes'] === undefined) {
                shippingAddress['extension_attributes'] = {};
            }

            $(shippingAddress.customAttributes).each(function() {
                if (shippingAddress.customAttributes.own_reference !== undefined) {
                    shippingAddress['extension_attributes']['own_reference'] = shippingAddress.customAttributes.own_reference;

                    return false;
                }
            });

            // pass execution to original action ('Magento_Checkout/js/action/set-shipping-information')
            return originalAction();
        });
    };
});
