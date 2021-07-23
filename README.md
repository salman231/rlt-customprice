# Custom Price

# Overview

A custom module to assign special prices to special customer
Here are some of the salient features for the extension:

```
1. You can now assign your own prices to your special customers
2. Your special customer can just login and see his/her price with Your Price label
3. Easy to manage from magento admin
4. Only one product can be assign at one time to one customer (1:1)
```


### Manually

1. Go to Magento® 2 root folder

2. Require/Download this extension:

   Enter following commands to install extension.

   ```
   composer require rlt/custom-price
   ```
   #### OR

   You can also download code from this repo under Magento® 2 following directory:

    ```
    app/code/RLT/CustomPrice
   
3. Enter following commands to enable the module:

   ```
   php bin/magento module:enable RLT_CustomPrice
   php bin/magento setup:upgrade
   php bin/magento cache:clean
   php bin/magento cache:flush
   ```
4. If Magento® is running in production mode, deploy static content:

   ```
   php bin/magento setup:static-content:deploy
   ```

5- Go to Admin Side and see the grid in RLTSquare->Custom Price menu for successful installation of module.

#NOTES:

- Custom price on storefront is handled by using an after plugin on getPrice method of Product.
  
- Custom table is being created with db_schema and Admin Grid is handled by UI Components.

- For handeling cache issues, the price of every product is fetched after sending a post request to fetch the price of product from database after discount calculations and then rendered on frontend using javascript.

#Limitations - this module has limitation specified below
 
- Special Prices will work with only Simple product types.

- Prices are not cached as on each product render an ajax request will be sent to the server to fetch the products latest price.

# Developed by: Salman Hanif
# Email: salman.hanif@rltsquare.com
# www.rltsquare.com
