<?php


namespace RadiateCode\DaChart\Html;

use Illuminate\Support\Facades\View;
use RadiateCode\DaChart\Contracts\ChartInterface;
use Illuminate\Support\HtmlString;

class Builder
{
    private $config = [];

    /**
     * @var ChartInterface $chart
     */
    private $chart;

    public function __construct(ChartInterface $chart)
    {
        $this->chart = $chart;
    }

    /**
     * Generate chart HTML
     *
     * @return HtmlString
     */
    public function chartHtml(): HtmlString
    {
        return new HtmlString(
            "<canvas id='".$this->chart->getChartName()."'></canvas>\n"
        );
    }

    /**
     * Generate chart script
     *
     * @return HtmlString
     */
    public function chartScript(): HtmlString
    {
        $script = $this->chartView(false);

        $chartCtxVar = $this->chart->getChartName();

        $chartConfigVar = $this->chart->getChartName()."_config";

        return new HtmlString(
            sprintf(
                "<script type='".('text/javascript')."'>\n{$script}\n</script>",
                $chartCtxVar,
                $chartConfigVar
            )
        );
    }

    /**
     * Generate api based chart script
     *
     * [note: api call by AJAX]
     *
     * @param  string  $url  // api link
     * @param  string|null  $fireEventElementId  // event trigger to load api data to chart
     *
     * @param  null  $filterElementIds  // ids used to get value from input and attach it as query string
     *
     * @return HtmlString
     */
    public function apiChartScript(
        string $url,
        string $fireEventElementId = null,
        ...$filterElementIds
    ): HtmlString {
        $script = $this->chartView();

        $chartCtxVar = $this->chart->getChartName();

        $chartConfigVar = $this->chart->getChartName()."_config";

        $inputs = implode("#", $filterElementIds);

        return new HtmlString(
            sprintf(
                "<script type='".('text/javascript')."'>\n{$script}\n</script>",
                $chartCtxVar,
                $chartConfigVar,
                $fireEventElementId,
                $url,
                $inputs
            )
        );
    }


    /**
     * Recent chart js library | cdn
     *
     * @return string
     */
    public function chartLibrary(): string
    {
        $config = $this->config();

        if ( ! empty($config['inject_plugins'])) {
            return new HtmlString(
                "<script src='https://cdn.jsdelivr.net/npm/chart.js'></script>\n"
                .$config['inject_plugins']['libraries']
            );
        }

        return new HtmlString(
            "<script src='https://cdn.jsdelivr.net/npm/chart.js'></script>"
        );
    }

    /**
     * Get javascript template to to config chart.
     *
     * @param  bool  $isApiView
     *
     * @return string
     */
    protected function chartView(bool $isApiView = true): string
    {
        $view = $isApiView ? 'dachart::api' : 'dachart::script';

        return View::make($view, $this->encoded())->render();
    }

    /**
     * @return array
     */
    protected function encoded(): array
    {
        $config = $this->config();

        return [
            'type'            => $config['type'],
            'labels'          => json_encode($config['data']['labels']),
            'datasets'        => json_encode($config['data']['datasets']),
            'options'         => is_array($config['options'])
                ? json_encode($config['options'])
                : $config['options'],
            'plugins_ids'     => empty($config['inject_plugins'])
                ? '[]'
                : $config['inject_plugins']['ids'],
            'plugins_options' => empty($config['inject_plugins'])
                ? ""
                : $config['inject_plugins']['options'],
        ];
    }

    private function config(): array
    {
        if (empty($this->config)) {
            $this->config = $this->chart->render();
        }

        return $this->config;
    }
}