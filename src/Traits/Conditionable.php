<?php


namespace RadiateCode\DaChart\Traits;

/**
 * Trait Conditionable
 *
 * [Note: Inspired from laravel Conditionable trait which introduced in Laravel 8.x]
 *
 * @package RadiateCode\DaChart\Traits
 */
trait Conditionable
{
    /**
     * Apply the callback if the given "value" is truthy.
     *
     * @param  mixed  $value
     * @param  callable  $callback
     * @param  callable|null  $default
     *
     * @return $this|mixed
     */
    public function when($value, callable $callback, callable $default = null)
    {
        if ($value) {
            return $callback($this, $value) ?: $this;
        } elseif ($default) {
            return $default($this, $value) ?: $this;
        }

        return $this;
    }
}