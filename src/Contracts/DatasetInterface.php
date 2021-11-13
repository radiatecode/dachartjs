<?php


namespace RadiateCode\DaChart\Contracts;


interface DatasetInterface
{
    public function label(string $label): DatasetInterface;

    public function stack(string $stack): DatasetInterface;

    public function stepped(string $stepped): DatasetInterface;

    public function type(string $type): DatasetInterface;

    public function tension(string $tension): DatasetInterface;

    public function hoverOffset(string $hoverOffset): DatasetInterface;

    public function rotation(string $rotation): DatasetInterface;

    public function cubicInterpolationMode(string $mode): DatasetInterface;

    public function xAxisID(string $xAxisID): DatasetInterface;

    public function yAxisID(string $yAxisID): DatasetInterface;

    public function order(string $order): DatasetInterface;

    public function hidden(string $hidden): DatasetInterface;

    public function pointStyle(string $pointStyle): DatasetInterface;

    public function borderWidth(int $width): DatasetInterface;

    public function borderRadius(int $radius): DatasetInterface;

    public function pointRadius(int $radius): DatasetInterface;

    public function borderSkipped(bool $borderSkipped): DatasetInterface;

    public function fill(bool $fill): DatasetInterface;

    public function data(array $data): DatasetInterface;

    public function segment(array $data): DatasetInterface;

    /**
     * | ---------------------------------------------------------------
     * | Color can be pass as array of rgb
     * | ---------------------------------------------------------------
     */
    public function backgroundColor($color): DatasetInterface;

    public function borderColor($color): DatasetInterface;

    public function pointBorderColor($color): DatasetInterface;

    public function pointHoverBackgroundColor($color): DatasetInterface;

    public function pointHoverBorderColor($color): DatasetInterface;

    /**
     * Used to generate dataset by most common properties
     * 
     * -----------------------------------------------------------------------------------------------
     * Note: If background and boarder colors are not set then it picked random pre-defined color
     * -----------------------------------------------------------------------------------------------
     *
     * @param  string  $label
     * @param  array  $data
     * @param  null  $backgroundColor
     * @param  null  $boarderColor
     *
     * @return DatasetInterface
     */
    public function dataset(string $label, array $data, $backgroundColor = null, $boarderColor = null): DatasetInterface;

    /**
     * Make a dataset array with properties
     *
     * @return array
     */
    public function make(): array;
}