<?php


namespace RadiateCode\DaChart\Contracts;


interface PluginInterface
{
    /**
     * Plugin libraries
     *
     * @return string
     */
    public function libraries(): string;

    /**
     * Plugin id to register in the chart
     *
     * @return string
     */
    public function id(): string;

    /**
     * Global plugin options to manipulate chart
     *
     * @return mixed
     */
    public function options();

}