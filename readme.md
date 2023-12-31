<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg">
</p>

# CRUD of products in Laravel + Vuejs

Create a webpage with a form that has the following text input fields: 
1. Product name
2. Quantity in stock
3. Price per item.

The submitted data of the form should be saved in an XML / JSON file with valid XML / JSON syntax.

Underneath of the form, the web page should display all of the data which has been submitted in rows ordered by date time submitted, the order of the data columns should be: Product name, Quantity in stock, Price per item, Datetime submitted, Total value number.

The "Total value number" should be calculated as (Quantity in stock * Price per item).

The last row should how a sum total of all of the Total Value numbers.
For extra credit, include functionality to edit each line.

Instructions:
### Solution requirements:
- Use PHP / Html / Javascript / CSS.
- Use Twitter Bootstrap.
- The form should be submitting the data and updating the data being displayed on the page using Ajax.
- Provide all the files related to the solution in one zip file, the solution should work directly after extracting it on a server without the need to modify anything in the files to make it work.


![Product List](./img/product_list.png)
<p>Product List using Blade</p>

![Product Edit](./img/product_update.png)
<p>Product Update using Vuejs components + Sweet Alert + Axios + Bootstrap</p>


