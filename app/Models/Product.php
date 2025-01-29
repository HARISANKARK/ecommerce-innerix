<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $primaryKey = "p_id";

    public function scopeFilter(Builder $query,array $filters) : Builder
    {
        $from = $filters['from'] ?? date('Y-m-d');
        $to = $filters['to'] ?? date('Y-m-d');

        return $query->when(
            $filters['category_id'] ?? false,
            function ($query, $value) {
                return $query->where('products.p_category_id','=', $value);
            }
        )->when(
            $filters['name'] ?? false,
            function ($query, $value) {
                return $query->where('products.p_name','=', $value);
            }
        )->when(
            $filters['lower_price'] ?? false,
            function ($query, $value) {
                return $query->where('products.p_price','>=', $value);
            }
        )->when(
            $filters['higher_price'] ?? false,
            function ($query, $value) {
                return $query->where('products.p_price','<=', $value);
            }
        );
    }

}
