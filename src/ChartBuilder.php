<?php


namespace RadiateCode\DaChart;

use RadiateCode\DaChart\Contracts\ChartInterface;
use Illuminate\Contracts\Config\Repository;
use Illuminate\Contracts\View\Factory;
use Illuminate\Support\HtmlString;

class ChartBuilder
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
        $this->view = $view;
        $this->config = $config;
    }

    /**
     * @param  ChartInterface  $chart
     *
     * @return $this
     */
    public function resolve(ChartInterface $chart): ChartBuilder
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
    public function chartScripts(): HtmlString
    {
        $script = $this->template();

        return new HtmlString(
            sprintf("<script type='".('text/javascript')."'>{$script}</script>\n",$this->chart->getChartName())
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
     * Get javascript template to use.
     *
     * @return string
     */
    protected function template(): string
    {
        return $this->view->make('dachart::script',['chart'=>$this->chart->render()])->render();
    }
}