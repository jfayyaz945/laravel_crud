<?php
namespace App\Filters;
use App\User;
use Illuminate\Http\Request;
//use Carbon\Carbon;
class ProductFilters extends QueryFilters
{
    protected $request;
    public function __construct(Request $request)
    {
        $this->request = $request;
        parent::__construct($request);
    }
  
    public function name($term) {
        return $this->builder->where('products.name', 'LIKE', "%$term%");
    }
  
    public function code($term) {
        return $this->builder->where('products.code', 'LIKE', "%$term%");
    }

    public function price($term) {
        return $this->builder->where('products.price', '=', "%$term%");
    }

}