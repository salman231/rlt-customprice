/**
 * applyCustomerPrice.js - A JS file to send post ajax request for the rendering of price on frontend
 *
 * @copyright Copyright © 2021 RLT. All rights reserved.
 */

define([
    "jquery",
    "Magento_Customer/js/customer-data",
    'Magento_Catalog/js/price-utils'

], function($, customerData, priceUtils){
    "use strict";
    function main(config, element) {
        var url = config.requestUrl + "/specialprice/product/price";
        var ProductId = config.ProductId;
        var OriginalPrice = config.OriginalPrice;

        $.ajax({
            url: url,
            type: "POST",
            data: { product_id : ProductId},
        }).done(function (data) {
            /* Hit the URL to fetch customer's applicable discounts product by product */
            /* URL will return error with notloggedin response incase customer is not logged in, and default prices will be shown in this case */
            /* URL will return default price of product if discount is not found for specific customer */
            /* URL will return the custom price for a product incase an entry is found for specific customer */
            /* Since the URL is working on POST request format, latest price of product will be shown to the customer */

            let finalPrice = 0;

            if((data.hasOwnProperty("notloggedIn") && data.notloggedIn === true) || !data.hasOwnProperty("price")){
                finalPrice = OriginalPrice;
            } else {
                finalPrice = data.price;
                if(data.label_bool) {
                    $('#special-price-' + data.product_id).wrap('<span class="price-label price">Your Price:</span>');
                }
            }
            $('#special-price-' + data.product_id).html(priceUtils.formatPrice(finalPrice, {decimalSymbol: '.'}));
            return true;
        })
    }

    return main;
});
