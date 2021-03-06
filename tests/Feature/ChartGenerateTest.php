<?php


namespace RadiateCode\DaChartjs\tests\Feature;

use RadiateCode\DaChartjs\Chart;
use RadiateCode\DaChartjs\Facades\Dataset;
use RadiateCode\DaChartjs\Types\Bar\HorizontalBarChart;
use RadiateCode\DaChartjs\Types\Bar\StackedBarChart;
use RadiateCode\DaChartjs\Types\Line\InterpolationLineChart;
use RadiateCode\DaChartjs\Types\Line\MultiAxisLineChart;
use RadiateCode\DaChartjs\Types\Line\SteppedLineChart;
use Illuminate\Support\HtmlString;
use RadiateCode\DaChartjs\tests\TestCase;

class ChartGenerateTest extends TestCase
{
    // run test by vendor/bin/phpunit --testsuite Feature
    // or vendor/phpunit/phpunit/phpunit --testsuite Feature

    /** @test */
    public function render_bar_chart_with_dataset_builder()
    {
        $datasets = [
            Dataset::label('Task')->data([20, 30])->backgroundColor('red')
                ->borderColor('black')->make(),
            Dataset::label('Project')->data([50, 80])->backgroundColor('green')
                ->borderColor('white')->make(),
        ];

        $barChart = (new Chart('Monthly Completion Chart',
            HorizontalBarChart::class))
            ->labels(['project', 'task'])
            ->datasets($datasets)
            ->render();

        $this->assertIsArray($barChart);
        $this->assertArrayHasKey('data', $barChart);
    }

    /** @test */
    public function render_bar_chart_with_plain_array_dataset()
    {
        $barChart = (new Chart('Monthly Chart', HorizontalBarChart::class))
            ->labels(['project', 'task'])
            ->datasets(
                [
                    [
                        "label"           => "January",
                        "backgroundColor" => "green",
                        "data"            => [100, 200],
                        "borderColor"     => "green",
                    ],
                    [
                        "label"           => "February",
                        "backgroundColor" => "red",
                        "data"            => [300, 400],
                        "borderColor"     => "red",
                    ],
                ]
            )
            ->render();

        $this->assertIsArray($barChart);
        $this->assertArrayHasKey('data', $barChart);
    }

    /** @test */
    public function render_bar_chart_with_custom_options()
    {
        $datasets = [
            Dataset::label('Task')->data([20, 30])->backgroundColor('red')
                ->borderColor('black')->make(),
            Dataset::label('Project')->data([50, 80])->backgroundColor('green')
                ->borderColor('white')->make(),
        ];

        $barChart = (new Chart('Completions Chart', HorizontalBarChart::class))
            ->options([
                'responsive' => false,
                'plugins'    => [
                    'legend' => [
                        'display'  => true,
                        'position' => 'top',
                    ],
                    'title'  => [
                        'text'     => 'Custom Title',
                        'position' => 'top',
                        'display'  => true,
                        'color'    => 'black',
                    ],
                ],
            ])
            ->labels(['project', 'task'])
            ->datasets($datasets)
            ->render();

        $this->assertIsArray($barChart);
        $this->assertArrayHasKey('data', $barChart);
    }

    /** @test */
    public function render_interpolation_line_chart_with_changing_default_options(
    )
    {
        $datasets = [
            Dataset::label('Task')->data([20, 30])->backgroundColor('red')
                ->borderColor('black')->make(),
            Dataset::label('Project')->data([50, 80])->backgroundColor('green')
                ->borderColor('white')->make(),
        ];

        $chart = (new Chart('Project# Chart', InterpolationLineChart::class))
            ->changeDefaultOption('plugins.title.text', 'My Interpolation Chart')
            ->changeDefaultOption('scales.x.title.text', 'Index X')
            ->changeDefaultOption('scales.y.title.text', 'Amount Y')
            ->labels(['project', 'task'])
            ->datasets($datasets)
            ->render();

        $this->assertIsArray($chart);
        $this->assertArrayHasKey('data', $chart);
    }


    /** @test */
    public function render_border_radius_bar_chart_with_dataset()
    {
        $datasets = [
            Dataset::label('Task')->data([120, 130])->backgroundColor('red')
                ->borderWidth(2)->borderRadius(5)->borderSkipped(false)->make(),
            Dataset::label('Project')->data([140, 150])
                ->backgroundColor('green')->borderWidth(2)->borderRadius(5)
                ->borderSkipped(true)->make(),
        ];

        $borderRadiusBarChart = (new Chart('Border Bar Chart',
            SteppedLineChart::class))
            ->labels(['project', 'task'])
            ->datasets($datasets)
            ->render();

        $this->assertIsArray($borderRadiusBarChart);

        foreach ($borderRadiusBarChart['data']['datasets'] as $item) {
            $this->assertArrayHasKey('borderWidth', $item);
            $this->assertArrayHasKey('borderRadius', $item);
        }
    }

    /** @test */
    public function render_multi_axis_line_chart_with_dataset()
    {
        $datasets = [
            Dataset::label('Task')->data([120, 130])->backgroundColor('red')
                ->yAxisID('y')->make(),
            Dataset::label('Project')->data([140, 150])
                ->backgroundColor('green')->yAxisID('y1')->make(),
        ];

        $multiAxisLineChart = (new Chart('Multi Axis Line Chart',
            MultiAxisLineChart::class))
            ->labels(['project', 'task'])
            ->datasets($datasets)
            ->render();

        $this->assertIsArray($multiAxisLineChart);

        foreach ($multiAxisLineChart['data']['datasets'] as $item) {
            $this->assertArrayHasKey('yAxisID', $item);
        }

        foreach ($multiAxisLineChart['options']['scales'] as $item) {
            $this->assertArrayHasKey('position', $item);
            $this->assertEquals($item['type'], 'linear');
        }
    }

    /** @test */
    public function resolve_bar_chart_template()
    {
        $datasets = [
            Dataset::label('Task')->data([20, 30])->make(),
            Dataset::label('Project')->data([50, 60])->make(),
        ];

        $barChart = (new Chart('Project Chart 1', StackedBarChart::class))
            ->labels(['project', 'task'])
            ->datasets($datasets)
            ->template();

        $this->assertInstanceOf(HtmlString::class, $barChart->chartScripts());
    }
}