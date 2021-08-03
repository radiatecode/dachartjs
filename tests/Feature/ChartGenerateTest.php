<?php


namespace DaCode\DaChart\tests\Feature;

use DaCode\DaChart\Chart;
use DaCode\DaChart\Data\TypeBaseDataset\BorderBarChartDataset;
use DaCode\DaChart\Data\TypeBaseDataset\SteppedLineChartDataset;
use DaCode\DaChart\Types\Bar\HorizontalBarChart;
use DaCode\DaChart\Types\Bar\StackedBarChart;
use DaCode\DaChart\Types\Bar\VerticalBarChart;
use DaCode\DaChart\Types\Line\MultiAxisLineChart;
use DaCode\DaChart\Types\Line\SteppedLineChart;
use Illuminate\Support\HtmlString;
use DaCode\DaChart\tests\TestCase;

class ChartGenerateTest extends TestCase
{

    // run test by vendor/bin/phpunit --testsuite Feature

    /** @test */
    public function render_bar_chart_with_dataset_builder()
    {
        $barChart = (new Chart('Project Chart 35', HorizontalBarChart::class))
            ->labels(['project', 'task'])
            ->data(
                function ($dataset) {
                    return $dataset->dataset('Task', [20, 30], 'red', 'black')
                        ->dataset('Project', [50, 88], 'green', 'white');
                }
            )
            ->render();

        $this->assertIsArray($barChart);
        $this->assertArrayHasKey('data', $barChart);
    }

    /** @test */
    public function render_bar_chart_with_plain_array_dataset()
    {
        $barChart = (new Chart('Project Chart 35', HorizontalBarChart::class))
            ->labels(['project', 'task'])
            ->data(
                function ($dataset) {
                    return [
                        [
                            "label" => "Task 1",
                            "backgroundColor" => "green",
                            "data" =>  [100, 200],
                            "borderColor" => "green"
                        ],
                        [
                            "label" => "Task 2",
                            "backgroundColor" => "red",
                            "data" =>  [300, 400],
                            "borderColor" => "red"
                        ]
                    ];
                }
            )
            ->render();

        $this->assertIsArray($barChart);
        $this->assertArrayHasKey('data', $barChart);
    }

    /** @test */
    public function render_bar_chart_with_custom_options()
    {
        $barChart = (new Chart('Project Chart 35', HorizontalBarChart::class))
            ->options(function (){
                return [
                    'responsive' => false,
                    'plugins' => [
                        'legend' => [
                            'display' => true,
                            'position' => 'top'
                        ],
                        'title' => [
                            'text' => 'Custom Title',
                            'position' => 'top',
                            'display' => true,
                            'color' => 'black'
                        ]
                    ]
                ];
            })
            ->labels(['project', 'task'])
            ->data(function ($dataset) {
                return $dataset->dataset('Task', [20, 30], 'red', 'black')
                    ->dataset('Project', [50, 88], 'green', 'white');
            })->render();

        $this->assertIsArray($barChart);
        $this->assertArrayHasKey('data', $barChart);
    }

    /** @test */
    public function render_stepped_line_chart_with_dedicated_dataset_class()
    {
        $steppedChart = (new Chart('Project Chart 35', SteppedLineChart::class))
            ->labels(['project', 'task'])
            ->data(
                function ($dataset) {
                    return (new SteppedLineChartDataset())
                        ->steppedDataset('Task', [120, 130], 'red', false, true)
                        ->steppedDataset('Project', [140, 150], 'red', false, true)
                        ->render();
                }
            )
            ->render();

        $this->assertIsArray($steppedChart);

        foreach ($steppedChart['data']['datasets'] as $item){
            $this->assertArrayHasKey('fill', $item);
            $this->assertArrayHasKey('stepped', $item);
        }
    }

    /** @test */
    public function render_border_radius_bar_chart_with_dedicated_dataset_class()
    {
        $borderRadiusBarChart = (new Chart('Border Bar Chart', SteppedLineChart::class))
            ->labels(['project', 'task'])
            ->data(
                function ($dataset) {
                    return (new BorderBarChartDataset())
                        ->barChartDataset('Task', [120, 130], 'red', 2, 5,false)
                        ->barChartDataset('Project', [140, 150], 'red', 2, 5,false)
                        ->render();
                }
            )
            ->render();

        $this->assertIsArray($borderRadiusBarChart);

        foreach ($borderRadiusBarChart['data']['datasets'] as $item){
            $this->assertArrayHasKey('borderWith', $item);
            $this->assertArrayHasKey('borderRadius', $item);
        }
    }

    /** @test */
    public function render_border_radius_bar_chart_with_dataset()
    {
        $borderRadiusBarChart = (new Chart('Border Bar Chart', SteppedLineChart::class))
            ->labels(['project', 'task'])
            ->data(
                function ($dataset) {
                    return $dataset->label('Task')->data([120, 130])->backgroundColor('red')->borderWith(2)->borderRadius(5)->borderSkipped(false)->make()
                        ->label('Project')->data([140, 150])->backgroundColor('green')->borderWith(2)->borderRadius(5)->borderSkipped(true)->make()
                        ->render();
                }
            )
            ->render();

        $this->assertIsArray($borderRadiusBarChart);

        foreach ($borderRadiusBarChart['data']['datasets'] as $item){
            $this->assertArrayHasKey('borderWith', $item);
            $this->assertArrayHasKey('borderRadius', $item);
        }
    }

    /** @test */
    public function render_multi_axis_line_chart_with_dataset()
    {
        $multiAxisLineChart = (new Chart('Multi Axis Line Chart', MultiAxisLineChart::class))
            ->labels(['project', 'task'])
            ->data(
                function ($dataset) {
                    return $dataset->label('Task')->data([120, 130])->backgroundColor('red')->yAxisID('y')->make()
                        ->label('Project')->data([140, 150])->backgroundColor('green')->yAxisID('y1')->make()
                        ->render();
                }
            )
            ->render();

        $this->assertIsArray($multiAxisLineChart);

        foreach ($multiAxisLineChart['data']['datasets'] as $item){
            $this->assertArrayHasKey('yAxisID', $item);
        }

        foreach ($multiAxisLineChart['options']['scales'] as $item){
            $this->assertArrayHasKey('position', $item);
            $this->assertEquals($item['type'], 'linear');
        }
    }

    /** @test */
    public function resolve_bar_chart_template()
    {
        $barChart = (new Chart('Project Chart 1', StackedBarChart::class))
            ->labels(['project', 'task'])
            ->data(
                function ($dataset) {
                    return $dataset->label('Task')->data([20, 30])->make()
                        ->label('Project')->data([50, 60])->make();
                }
            )
            ->template();

        $this->assertInstanceOf(HtmlString::class, $barChart->chartScripts());
    }
}