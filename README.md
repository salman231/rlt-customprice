# Custom Price - a custom module to assign special prices to customers

#INSTALLATION:
- Unzip the package and copy/paste in app/code Under RLT Vendor

- You can also install package using composer : composer require rlt/custom-price

- Run the command bin/magento setup:upgrade and enable Module by 
   running bin/magento module:enable RLT_CustomPrice command

- Run di:compile and cache:flush for complete installation.

- Go to Admin Side and see the grid in RLTSquare->Custom Price menu for successful installation of module.

#NOTES:

- Custom price on storefront is handled by using an after plugin on getPrice method of Product.
  
- Custom table is being created with db_schema and Admin Grid is handled by UI Components.

- For handeling cache issues, the price of every product is fetched after sending a post request to fetch the price of product from database after discount calculations and then rendered on frontend using javascript.

#Limitations - this module has limitation specified below
 
- Special Prices will work with only Simple product types.

- Prices are not cached and on each product render an ajax request will be sent to the server to fetch the products latest price.

# Developed by: Salman Hanif
# Email: salman.hanif@rltsquare.com
