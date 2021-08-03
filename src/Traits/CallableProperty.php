<?php


namespace RadiateCode\DaChart\Traits;


use BadMethodCallException;
use Illuminate\Support\Arr;

trait CallableProperty
{
    private $properties = [];

    private $calls = [];

    /**
     * @param  string  $name
     * @param  string  $type
     *
     * @return $this
     */
    public function addProperty(string $name, string $type){
        $this->properties[$name] = ['type'=>$type];

        return $this;
    }

    /**
     * Get all properties
     *
     * @return array
     */
    public function properties(): array
    {
        return $this->properties;
    }

    /**
     * Get all callable methods
     *
     * @return array
     */
    public function calls(): array
    {
        return $this->calls;
    }

    /**
     * Reset properties
     *
     */
    public function resetProperties()
    {
        $this->properties = [];

        return $this;
    }

    /**
     * Reset callables
     *
     */
    public function resetCallableMethods()
    {
        $this->calls = [];

        return $this;
    }

    /**
     * This will allow to call a method by the exact same name which are listed in properties array
     * [It creates callable methods dynamically]
     *
     * @param $method
     * @param $parameters
     *
     * @return $this
     *
     * @throws BadMethodCallException
     */
    public function __call($method, $parameters)
    {
        if (Arr::has($this->properties,$method)){
            $this->calls[$method] = $parameters[0];

            return $this;
        }

        throw new BadMethodCallException("Method {$method} does not exist.");
    }
}