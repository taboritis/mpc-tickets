<?php

/**
 * Shortcut to factory
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
