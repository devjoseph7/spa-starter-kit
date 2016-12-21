<?php

namespace App\Http\Controllers;

use App\Support\Response;
use Illuminate\Http\Request;
use App\Traits\QueryParameters;
use App\Transformers\Transform;

abstract class ApiController extends Controller
{
    use QueryParameters;

    /**
     * HTTP Request.
     *
     * @var \Illuminate\Http\Request
     */
    protected $request;

    /**
     * API Response helper.
     *
     * @var \App\Support\Response
     */
    protected $response;

    /**
     * API transformer helper.
     *
     * @var \App\Transformers\Transform
     */
    protected $transform;

    /**
     * Creates a new class instance.
     *
     * @param Request   $request
     * @param Response  $response
     * @param Transform $transform
     */
    public function __construct(Request $request, Response $response, Transform $transform)
    {
        $this->request = $request;
        $this->response = $response;
        $this->transform = $transform;
    }
}
