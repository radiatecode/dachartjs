<?php


namespace RadiateCode\DaChart\Traits;


use BadMethodCallException;
use Illuminate\Support\Arr;
use TypeError;

trait CallableProperty
{
    private $properties = [];

    private $calls = [];

    /**
     * @param  string  $name
     * @param ...$types
     *
     * @return $this
     */
    public function addProperty(string $name,  ...$types){
        $this->properties[$name] = ['type'=>$types];

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
            $paramType = gettype($parameters[0]);

            $expectedTypes = $this->properties[$method]['type'];

            if (! in_array($paramType,$expectedTypes)){
                $types = implode(" or ",$expectedTypes);

                throw new TypeError('Argument must be type of '.$types.", ".$paramType." given!");
            }

            $this->calls[$method] = $parameters[0];

            return $this;
        }

        throw new BadMethodCallException("Method {$method} does not exist.");
    }
}