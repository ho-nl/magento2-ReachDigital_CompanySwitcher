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

            if (shippingAddress.customAttributes[0] === undefined) {
                // pass execution to original action ('Magento_Checkout/js/action/set-shipping-information')
                return originalAction();
            }

            if (shippingAddress['extension_attributes'] === undefined) {
                shippingAddress['extension_attributes'] = {};
            }

            $(shippingAddress.customAttributes).each(function(index) {
                if (shippingAddress.customAttributes[index].attribute_code === 'own_reference') {
                  shippingAddress['extension_attributes']['own_reference'] = shippingAddress.customAttributes[index].value;

                  if (shippingAddress.customAttributes.length === 1) {
                      delete shippingAddress.customAttributes;
                  } else {
                      delete shippingAddress.customAttributes[index];
                  }

                  return false;
                }
            });

            // pass execution to original action ('Magento_Checkout/js/action/set-shipping-information')
            return originalAction();
        });
    };
});
