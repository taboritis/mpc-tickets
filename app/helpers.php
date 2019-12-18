<?php

/**
 * Shortcut to factory with method create
 *
 * @param $class
 * @param array $attributes
 * @param null $times
 *
 * @return mixed
 */
function create($class, $attributes = [], $times = null)
{
    return factory($class, $times)->create($attributes);
}

/**
 * Shortcut to factory with method make
 *
 * @param $class
 * @param array $attributes
 * @param null $times
 *
 * @return mixed
 */
function make($class, $attributes = [], $times = null)
{
    return factory($class, $times)->make($attributes);
}

/**
 * It prevents generating tons on new records
 *
 * @param $class
 * @param array $attributes
 *
 * @return mixed
 */
function existedOrNew($class, $attributes = [])
{
    $records = $class::where($attributes);

    return ($records->count() > 0) ? $records->inRandomOrder()->first() : create($class, $attributes);
}
