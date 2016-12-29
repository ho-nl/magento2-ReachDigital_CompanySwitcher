/*
 * Copyright © 2016 H&O E-commerce specialisten B.V. (http://www.h-o.nl/)
 * See LICENSE.txt for license details.
 */
define([
    'jquery',
    'uiComponent',
    'Magento_Ui/js/lib/view/utils/dom-observer'
], function ($, Component, domObserver) {
    'use strict';

    return Component.extend({
        /**
         * Initialize view.
         *
         * @returns {Component} Chainable.
         */
        initialize: function () {
            this._super();
            this.bindEvent();
            return this;
        },

        bindEvent: function () {
            // Wait until element is available
            domObserver.get('input[name="billing[type]"]', function () {
                $('input[name="billing[type]"]').change(function() {
                    var value = $('input[name="billing[type]"]:checked').val();
                    if (value == '1') {
                        $('div[name="shippingAddress.company"]').hide();
                        $('div[name="shippingAddress.vat_id"]').hide();
                    }
                    else {
                        $('div[name="shippingAddress.company"]').show();
                        $('div[name="shippingAddress.vat_id"]').show();
                    }
                });
            }.bind(this));
        }
    });
});
