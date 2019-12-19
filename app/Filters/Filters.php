<?php

namespace App\Filters;

use Illuminate\Http\Request;

/**
 * Smart solution stolen from Jeffrey Way :)
 * Class Filters
 * @package App\Filters
 */
abstract class Filters
{
    protected $filters = [];

    protected $builder;

    /**
     * @var Request
     */
    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function apply($builder)
    {
        $this->builder = $builder;

        foreach ($this->getFilters() as $filter => $value) {
            if (method_exists($this, $filter)) {
                if ($value != null) {
                    $this->$filter($value);
                }
            }
        }

        return $this->builder;
    }

    private function getFilters()
    {
        return $this->request->only($this->filters);
    }
}