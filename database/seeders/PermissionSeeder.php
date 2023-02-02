<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::table('permissions')->truncate();
        $query = "INSERT INTO `permissions` (`id`, `parent_id`, `name`, `slug`, `description`) VALUES
        (1, 0, 'Branches', 'branches', 'Access Branches Module'),
        (2, 1, 'View Branches', 'view_branches', 'View All Branches'),
        (3, 1, 'Create Branches', 'create_branches', 'Create New Branches'),
        (4, 1, 'Edit Branches', 'edit_branches', 'Edit Branches'),
        (5, 1, 'Delete Branches', 'delete_branches', 'Delete Branch'),
        (6, 0, 'Clients', 'clients', 'Access Clients Module'),
        (7, 6, 'View Clients', 'view_clients', 'View All Clients'),
        (8, 6, 'Create Clients', 'create_clients', 'Create New Clients'),
        (9, 6, 'Edit Clients', 'edit_clients', 'Edit Clients'),
        (10, 6, 'Delete Clients', 'delete_clients', 'Delete Clients'),
        (11, 0, 'Sales', 'sales', 'Access Sales Module'),
        (12, 11, 'View Sales', 'view_sales', 'View All Sales'),
        (13, 11, 'Create Sales', 'create_sales', 'Create New Sales'),
        (14, 11, 'Edit Sales', 'edit_sales', 'Edit Sales'),
        (15, 11, 'Delete Sales', 'delete_sales', 'Delete Sales'),
        (16, 0, 'Users', 'users', 'Access Users Module'),
        (17, 16, 'View Users', 'view_users', 'View All Users'),
        (18, 16, 'Create Users', 'create_users', 'Create New Users'),
        (19, 16, 'Edit Users', 'edit_users', 'Edit Users'),
        (20, 16, 'Delete Users', 'delete_users', 'Delete Users'),
        (21, 0, 'Settings', 'settings', 'Access Settings Module'),
        (22, 21, 'View Settings', 'view_settings', 'View All Settings'),
        (23, 0, 'Products', 'products', 'Access Products Module'),
        (24, 23, 'Create Products', 'create_products', 'Create New Products'),
        (25, 23, 'View Products', 'view_products', 'View Products'),
        (26, 23, 'Edit Products', 'edit_products', 'Edit Products'),
        (27, 23, 'Delete Products', 'delete_products', 'Delete Products'),
        (28, 23, 'Create Product Categories', 'create_product_categories', 'Create New Product Categories'),
        (29, 23, 'View Product Categories', 'view_product_categories', 'View Product Categories'),
        (30, 23, 'Edit Product Categories', 'edit_product_categories', 'Edit Product Categories'),
        (31, 23, 'Delete Product Categories', 'delete_product_categories', 'Delete Product Categories');";

        DB::unprepared($query);
    }
}
