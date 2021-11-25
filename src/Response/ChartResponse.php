<?php


namespace RadiateCode\DaChart\Response;


use Illuminate\Http\JsonResponse;

class ChartResponse
{
    private $labels = [];

    private $datasets = [];

    public function labels(array $labels): ChartResponse
    {
        $this->labels = $labels;

        return $this;
    }

    public function datasets(array $datasets): ChartResponse
    {
        $this->datasets = $datasets;

        return $this;
    }

    public function toJson(): JsonResponse
    {
        $data = [];

        if ($this->labels){
            $data['labels'] = $this->labels;
        }

        if ($this->datasets){
            $data['datasets'] = $this->datasets;
        }

        return response()->json($data,200);
    }

    public function toArray(): array
    {
        $data = [];

        if ($this->labels){
            $data['labels'] = $this->labels;
        }

        if ($this->datasets){
            $data['datasets'] = $this->datasets;
        }

        return $data;
    }
}