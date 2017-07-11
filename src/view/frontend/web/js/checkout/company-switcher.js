/*
 * Copyright © 2017 H&O E-commerce specialisten B.V. (http://www.h-o.nl/)
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
            this.getElements();
            return this;
        },

        getElements: function () {
            // Wait until elements are available.
            var self = this;
            var elements = 'input[name="billing[type]"], div[name="shippingAddress.company"], div[name="shippingAddress.vat_id"], div[name="shippingAddress.custom_attributes.own_reference"]';
            var elementCount = elements.split(',').length;
            var elementsLoaded = 0;
            domObserver.get(elements, function () {
                elementsLoaded++;
                if(elementsLoaded == elementCount) {
                    self.bindEvent();
                }
            }.bind(this));
        },

        bindEvent: function () {
            $('div[name="shippingAddress.company"]').hide();
            $('div[name="shippingAddress.vat_id"]').hide();
            $('div[name="shippingAddress.custom_attributes.own_reference"]').hide();

            $('input[name="billing[type]"]').change(function () {
                var value = $('input[name="billing[type]"]:checked').val();

                if (value != '1') {
                    $('div[name="shippingAddress.company"]').hide();
                    $('div[name="shippingAddress.vat_id"]').hide();
                    $('div[name="shippingAddress.custom_attributes.own_reference"]').hide();
                } else {
                    $('div[name="shippingAddress.company"]').show();
                    $('div[name="shippingAddress.vat_id"]').show();
                    $('div[name="shippingAddress.custom_attributes.own_reference"]').show();
                }
            });
        }
    });
});
