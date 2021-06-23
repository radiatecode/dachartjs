<?php


namespace DaCode\DaChart\Data;


class Data
{
    /**
     * Chart data labels
     *
     * @var $labels
     */
    private $labels;

    /**
     * @var $datasets
     */
    private $datasets;

    /**
     * Set data labels
     *
     * @param  array  $labels
     *
     * @return $this
     */
    public function labels(array $labels): Data
    {
        $this->labels = $labels;

        return $this;
    }

    /**
     * Set dataset
     *
     * @param  array  $dataset
     *
     * @return $this
     */
    public function datasets(array $dataset): Data
    {
        $this->datasets = $dataset;

        return $this;
    }

    /**
     * Render data
     *
     * @return array
     */
    public function render(): array
    {
        return [
            'labels'=> $this->labels,
            'datasets' => $this->datasets
        ];
    }
}