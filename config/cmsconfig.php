<?php
return [
    //List of modules are defined here
    'modules' => [
        'home' => "Admin Dashboard",

        'user' => "User Management",
     'category' => "Category Management",
     'product' => "Product Management",
     'news' => "News Management",
     'order' => "Order Management",
        'page' => "Page Management",

        'setting' => "Company Information",
        'contact' => "Contact Management",


    ],
    //Module sub modules contains here
    'modulepages' => [
        'home' => ['home' => 'Admin Dashboard'],
        'user' => ['user' => 'Users', 'customer' => "Customers"],
        'category' => ['category' => 'Category'],
        'product' => ['product' => 'Product'],
        'news' => ['news' => 'News'],
        'order' => ['order' => 'Order'],
        'setting' => ["setting" => "Site Setting"],
        'page' => ["page" => "Page Management"],
        'contact' => ["contact" => "Contact Management"],



    ],
    //Permissions for each module is defined here
    'modulepermissions' => [


        'user' => [
            //Roles Sub Module
            'user.role.index' => 'View Roles',
            'user.role.create' => 'Create Roles',
            'user.role.edit' => 'Edit Roles',
            'user.role.destroy' => 'Delete Roles',
            //Users Sub Module
            'user.user.index' => 'View Users',
            'user.user.create' => 'Create Users',
            'user.user.edit' => 'Edit Users',
            'user.user.destroy' => 'Delete Users',

            'user.user.profile' => 'Change Personal Profile',

            'user.customer.index' => 'View Customer',
            'user.customer.create' => 'Create Customer',
            'user.customer.edit' => 'Edit Customer',
            'user.customer.destroy' => 'Delete Customer',

        ],
        'category' => [
            //Roles Sub Module
            'category.category.index' => 'View Employee',
            'category.category.create' => 'Create Employee',
            'category.category.edit' => 'Edit Employee',
            'category.category.destroy' => 'Delete Employee',


        ],
        'page' => [
            'page.page.index' => 'View Page',
            'page.page.create' => 'Create Page',
            'page.page.edit' => 'Edit Page',
            'page.page.destroy' => 'Delete Page',
        ],


        'contact' => [
            'contact.contact.index' => 'View contact',

        ],

        'order' => [
            //Roles Sub Module
            'order.order.index' => 'View Order',
            'order.order.create' => 'Create Order',
            'order.order.edit' => 'Edit Order',
            'order.order.destroy' => 'Delete Order',


        ],

        'product' => [
            //Roles Sub Module
            'product.product.index' => 'View Product',
            'product.product.create' => 'Create Product',
            'product.product.edit' => 'Edit Product',
            'product.product.destroy' => 'Delete Product',


        ],
        'setting' => [

        ], 'setting.setting.index' => 'View setting',

        'news' => [
            //Roles Sub Module
            'news.news.index' => 'View News',
            'news.news.create' => 'Create News',
            'news.news.edit' => 'Edit News',
            'news.news.destroy' => 'Delete News',


        ],


    ],
    //Icons for eash modules is defined here
    'moduleicons' => [
        'home' => 'icon-home',
        'user' => 'icon-users',
        'category' => 'icon-cart',
        'product' => 'fa fa-cubes',
        'news' => 'fa fa-newspaper-o',
        'order' => 'fa fa-table pending-order-count',
        'page' => 'fa fa-newspaper-o',
        'setting' => 'fa fa-cogs',
        'contact' => 'fa fa-phone',




    ],

];
