<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * @OA\Info(title="Coding Collective Test", version="0.1")

 * @OA\SecurityScheme(
 *    securityScheme="passport",
 *    in="header",
 *    name="passport",
 *    type="http",
 *    scheme="bearer",
 *    bearerFormat="Passport",
 * ),
 */
class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
}
