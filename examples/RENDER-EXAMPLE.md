# Example of render()
Here we will show how to use back-end configured chart in javascript.
## Back-End Configuration
In both ways we will configure chart, chose either one.
### 1. Generate chart by dedicated class
    php artisan make:dachartjs MonthlyChart
```php
namespace App\Charts;

use RadiateCode\DaChartjs\Abstracts\AbstractChart;
use RadiateCode\DaChartjs\Facades\Dataset;
use RadiateCode\DaChartjs\Types\Bar\HorizontalBarChart;

class MonthlyChart extends AbstractChart
{
    protected function chartTitle(): string
    {
        return 'Month Chart';
    }

    protected function chartType(): string
    {
        return HorizontalBarChart::class;
    }

    protected function labels(): array
    {
        return ['January','February','March'];
    }

    protected function datasets(): array
    {
        return [
            Dataset::general('Project',[20, 30,55])->make(),
            Dataset::general('Task',[50, 80,44])->make(),
            Dataset::general('Issue',[70, 75,99])->make()
        ];
    }
}
```
**In controller: now use the class in the controller**
```php
use App\Charts\MonthlyChart;

class ChartController extends Controller {
    public function index(){
        $chart = new MonthlyChart();
        
        return view('charts.monthly_completion')->with('chart',$chart->render());
    }
}
```
### 2. Or, generate chart by service
```php
use RadiateCode\DaChartjs\Chart;
use RadiateCode\DaChartjs\Types\Bar\HorizontalBarChart;

class ChartController extends Controller {
    public function index(){
            /**
            * --------------------------------------
            * 1. create chart with modification of default options 
            * --------------------------------------
            */
//            $chart = (new Chart('Monthly Chart', HorizontalBarChart::class))
//                ->changeDefaultOption('plugins.title.text','Monthly Project, Task And Issue Chart')
//                ->changeDefaultOption('plugins.title.color','blue')
//                ->labels(['January', 'February','March'])
//                ->datasets($datasets)
//                ->render();    
                
            /**
            * --------------------------------------
            * 2. create chart with custom options 
            * --------------------------------------
            */
            $chart = (new Chart('Monthly Chart', HorizontalBarChart::class))
                ->options([ // Custom options
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
                ->labels(['January', 'February','March'])
                ->datasets([ // Dataset configured in raw array
                    [
                        "label"           => "Task",
                        "backgroundColor" => "yellow",
                        "data"            => [20, 30,55],
                        "borderColor"     => "yellow",
                    ],
                    [
                        "label"           => "Project",
                        "backgroundColor" => "green",
                        "data"            => [50, 80,44],
                        "borderColor"     => "green",
                    ],
                    [
                        "label"           => "Issue",
                        "backgroundColor" => "red",
                        "data"            => [70, 75,99],
                        "borderColor"     => "red",
                    ],
                ])
                ->render();     
               
            return view('charts.monthly_completion')->with('chart',$chart);       
    }
}
```

## Front-End configuration
**In view (monthly_completion.blade.php):**
```html
<div class="chart">
    <div class="chart">
        <!-- canvas html -->
        <canvas id="monthly_chart_canvas"></canvas>
    </div>
</div>

<script>
var serversideRenderedChartConfig = {!! json_encode($chart) !!}

var chartCtx = document.getElementById("monthly_chart_canvas").getContext('2d');

var monthlyChart = new Chart(chartCtx,serversideRenderedChartConfig);
</script>
```