<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait QueryFilter
{
    // For filter
    public function scopeFilter($query, $params)
    {
        if (!$params) {
            return $query;
        }

        foreach ($params as $field => $value) {

            // ex: filterStatus
            $method = 'filter' . Str::studly($field);

            if ($value === '' || $value == null) {
                session()->forget("filter.$this->table.$field");
                continue;
            }

            // Check method exist and call it
            if (method_exists($this, $method)) {
                session()->put("filter.$this->table.$field", $value);
                $this->{$method}($query, $value);
            }

            if (empty($this->filterable) || !is_array($this->filterable)) {
                continue;
            }

            // Filter by field if field exits in params and in filterable model
            if (in_array($field, $this->filterable)) {
                session()->put("filter.$this->table.$field", $value);
                $query->where($this->table . '.' . $field, $value);
                continue;
            }
        }

        // $this->scopeOrderBy($params['orderBy'], $params['orderByRole']);
        // if (array_key_exists("orderBy", $params) && array_key_exists("orderByRole", $params)) {
        //     if ($params["orderBy"] != "" && $params["orderByRole"] != "" && $params["orderBy"] && $params["orderByRole"]) {
        //         session()->put("filter.$this->table.orderBy", $params['orderBy']);
        //         session()->put("filter.$this->table.orderByRole", $params['orderByRole']);

        //         // filter if product has sale_price
        //         if ($params['orderBy'] == 'product_price') {
        //             $role = $params['orderByRole'];

        //             return $query
        //                 ->orderByRaw("CASE WHEN products.sale_price > 0 THEN sale_price ELSE price END $role");
        //         }
        //         // orderBy count of order details
        //         if ($params['orderBy'] == 'order_details_count') {
        //             $role = $params['orderByRole'];

        //             return $query
        //                 ->withCount('orderDetails')->orderBy('order_details_count', $role);
        //         }
        //         // orderBy count of products
        //         if ($params['orderBy'] == 'products_count') {
        //             $role = $params['orderByRole'];

        //             return $query
        //                 ->withCount('products')->orderBy('products_count', $role);
        //         }
        //         return $query->orderBy($this->table . '.' . $params['orderBy'], $params['orderByRole']);
        //     }
        // }

        return $query;
    }
}
