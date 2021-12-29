<?php


namespace RadiateCode\DaChartjs\Html;

use Illuminate\Support\Facades\View;
use Illuminate\Support\HtmlString;

class Builder
{
    private $chartName;
    private $renderedData = [];
    private $size = [];
    protected $isAjaxScriptCalled = false;

    public function __construct(
        string $chartName,
        array $renderedData,
        array $chartSize
    ) {
        $this->chartName    = $chartName;
        $this->renderedData = $renderedData;
        $this->size         = $chartSize;
    }

    /**
     * Generate chart HTML
     *
     * @return HtmlString
     */
    public function chartHtml(): HtmlString
    {
        if (empty($this->size)){
            return new HtmlString(
                "<canvas id='".$this->chartName."'></canvas>\n"
            );
        }

        if (empty($this->size['width'])){
            return new HtmlString(
                "<canvas id='".$this->chartName."' height='".$this->size['height']."'></canvas>\n"
            );
        }

        return new HtmlString(
            "<canvas id='".$this->chartName."' height='".$this->size['height']."' width='".$this->size['width']."'></canvas>\n"
        );
    }

    /**
     * Generate chart script
     *
     * @return HtmlString
     */
    public function chartScripts(): HtmlString
    {
        $script = $this->chartView(false);

        $chartCtxVar = $this->chartName;

        $chartConfigVar = $this->chartName."_config";

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
     * @param  array|string  $ajaxOptions  // can be url string or array of ajaxOptions
     *
     * --------------------------------------------------------------------------------
     * Chart Update params
     *
     * @param  string|null  $clickEventId  // trigger event to load api data to chart
     * @param  array  $inputElementIds  // ids used to get value from form elements and attach it as query string
     * --------------------------------------------------------------------------------
     *
     * @return HtmlString
     */
    public function apiChartScripts(
        $ajaxOptions,
        string $clickEventId = null,
        array $inputElementIds = []
    ): HtmlString {
        $ajaxScripts = $this->ajaxView();

        $script = $this->chartView();

        $chartCtxVar = $this->chartName;

        $chartConfigVar = $this->chartName."_config";

        if (is_string($ajaxOptions)) {
            $ajaxOptions = ['url' => $ajaxOptions];
        }

        return new HtmlString(
            sprintf(
                "<script type='".('text/javascript')."'>\n{$script}\n{$ajaxScripts}\n</script>",
                $chartCtxVar,
                $chartConfigVar,
                $clickEventId,
                json_encode($ajaxOptions),
                json_encode($inputElementIds)
            )
        );
    }

    /**
     * Recent chart js cdn library
     *
     * @return string
     */
    public function chartLibraries(): string
    {
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
     * @return string
     */
    protected function ajaxView(): string
    {
        return View::make('dachart::ajax_min')->render();
    }

    /**
     * @return array
     */
    protected function encoded(): array
    {
        $config = $this->renderedData;

        return [
            'type'     => $config['type'],
            'labels'   => json_encode($config['data']['labels']),
            'datasets' => json_encode($config['data']['datasets']),
            'options'  => is_array($config['options'])
                ? json_encode($config['options'])
                : $config['options'],
        ];
    }
}