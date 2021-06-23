<?php


namespace DaCode\DaChart\Data;


class Data
{
    private $labels;

    private $datasets;

    public function labels(array $labels): Data
    {
        $this->labels = $labels;

        return $this;
    }

    public function datasets(array $dataset): Data
    {
        $this->datasets = $dataset;

        return $this;
    }

    public function render(): array
    {
        return [
            'labels'=> $this->labels,
            'datasets' => $this->datasets
        ];
    }
}