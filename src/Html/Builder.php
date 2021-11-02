<?php


namespace RadiateCode\DaChart\Html;

use RadiateCode\DaChart\Contracts\ChartInterface;
use Illuminate\Contracts\Config\Repository;
use Illuminate\Contracts\View\Factory;
use Illuminate\Support\HtmlString;

class Builder
{
    /**
     * @var Factory $view
     */
    private $view;

    /**
     * @var Repository $config
     */
    private $config;

    /**
     * @var ChartInterface $chart
     */
    private $chart;

    public function __construct(Factory $view, Repository $config)
    {
        $this->view   = $view;
        $this->config = $config;
    }

    /**
     * @param  ChartInterface  $chart
     *
     * @return $this
     */
    public function resolve(ChartInterface $chart): Builder
    {
        $this->chart = $chart;

        return $this;
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
        $script = $this->jsConfig();

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
     * @param  string  $clickEventId  // event trigger to load api data to chart
     * @param  string  $url  // api link
     *
     * send data to api source
     * data format should be like "key1=value1&key2=value2&key3=value3"
     * @param  string|null  $sendData
     *
     * @return HtmlString
     */
    public function apiChartScript(string $clickEventId, string $url, string $sendData = null): HtmlString
    {
        $script = $this->jsApiConfig();

        $chartCtxVar = $this->chart->getChartName();

        $chartConfigVar = $this->chart->getChartName()."_config";

        return new HtmlString(
            sprintf(
                "<script type='".('text/javascript')."'>\n{$script}\n</script>",
                $chartCtxVar,
                $chartConfigVar,
                $clickEventId,
                $url,
                $sendData
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
        return new HtmlString(
            "<script src='https://cdn.jsdelivr.net/npm/chart.js'></script>"
        );
    }

    /**
     * Get javascript template to config chart.
     *
     * @return string
     */
    protected function jsConfig(): string
    {
        return $this->view->make('dachart::script', ['chartConfig' => $this->chart->render()])->render();
    }

    /**
     * Get javascript template to to config api base chart.
     *
     * @return string
     */
    protected function jsApiConfig(): string
    {
        $chartConfig = $this->chart->render();

        $datasetsLength = count($chartConfig['data']['datasets']);

        return $this->view->make('dachart::api',
            [
                'chartConfig'    => $chartConfig,
                'datasetsLength' => $datasetsLength,
            ]
        )->render();
    }
}