<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $primaryKey ='o_id';
    protected $dates = ['deleted_at'];

    public function scopeFilter(Builder $query,array $filters) : Builder
    {
        $from = $filters['from'] ?? date('Y-m-d');
        $to = $filters['to'] ?? date('Y-m-d');

        return $query->when(
            $filters['product_id'] ?? false,
            function ($query, $value) {
                return $query->where('orders.product_id','=', $value);
            }
        )->when(
            $filters['category_id'] ?? false,
            function ($query, $value) {
                return $query->where('orders.category_id','=', $value);
            }
        )->when(
            $from && $to,
            function ($query) use ($from, $to) {
                $query->whereBetween('date', [$from, $to]);
            }
        );
    }

}
