<?php

namespace App\Http\Controllers;

use App\Services\CommonService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    protected $commonService;

    public function __construct(CommonService $commonService)
    {
        $this->middleware('auth');

        $this->commonService = $commonService;
    }

}
