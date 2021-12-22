<?php


namespace RadiateCode\DaChartjs\Contracts;


interface DatasetInterface
{
    public function label(string $label): DatasetInterface;

    public function stack(string $stack): DatasetInterface;

    public function stepped(string $stepped): DatasetInterface;

    public function type(string $type): DatasetInterface;

    public function tension(string $tension): DatasetInterface;

    public function hoverOffset(string $hoverOffset): DatasetInterface;

    public function cubicInterpolationMode(string $mode): DatasetInterface;

    public function xAxisID(string $xAxisID): DatasetInterface;

    public function yAxisID(string $yAxisID): DatasetInterface;

    public function order(string $order): DatasetInterface;

    public function hidden(string $hidden): DatasetInterface;

    public function pointStyle(string $pointStyle): DatasetInterface;
    
    public function borderJoinStyle(string $borderJoinStyle): DatasetInterface;
    
    public function borderAlign(string $borderAlign): DatasetInterface;

    public function rotation($rotation): DatasetInterface;
    
    public function spacing($spacing): DatasetInterface;
    
    public function weight($weight): DatasetInterface;
    
    public function circumference($circumference): DatasetInterface;
    
    public function borderWidth($width): DatasetInterface;

    public function borderRadius($radius): DatasetInterface;

    public function pointRadius($radius): DatasetInterface;

    public function pointRotation($rotation): DatasetInterface;

    public function barPercentage($percentage): DatasetInterface;

    public function barThickness($thickness): DatasetInterface;

    public function maxBarThickness($thickness): DatasetInterface;

    public function minBarLength($length): DatasetInterface;

    public function hoverBorderWidth($width): DatasetInterface;
    
    public function hoverBorderRadius($radius): DatasetInterface;

    public function pointHoverBorderWidth($width): DatasetInterface;
    
    public function pointHitRadius($radius): DatasetInterface;
    
    public function pointHoverRadius($radius): DatasetInterface;
    
    public function borderDashOffset($offset): DatasetInterface;
    
    public function offset(float $offset): DatasetInterface;

    public function skipNull(bool $borderSkipped): DatasetInterface;
    
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

    public function pointBackgroundColor($color): DatasetInterface;
    
    public function pointBorderColor($color): DatasetInterface;

    public function pointHoverBackgroundColor($color): DatasetInterface;

    public function pointHoverBorderColor($color): DatasetInterface;

    public function hoverBackgroundColor($color): DatasetInterface;

    public function hoverBorderColor($color): DatasetInterface;

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
    public function general(string $label, array $data, $backgroundColor = null, $boarderColor = null): DatasetInterface;

    /**
     * Make a dataset array with properties
     *
     * @return array
     */
    public function make(): array;
}