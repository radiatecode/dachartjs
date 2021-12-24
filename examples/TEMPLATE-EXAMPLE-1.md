# Examples of Html builder: chartScripts()
Here we will show how to configure and use html builder.
## Back-End Configuration
In both ways we will configure chart, chose either one.
### 1. Generate chart by dedicated class
```php
namespace App\Charts;

use RadiateCode\DaChartjs\Abstracts\AbstractChart;
use RadiateCode\DaChartjs\Facades\Dataset;
use RadiateCode\DaChartjs\Types\Bar\VerticalBarChart;

class MonthlyCompletionChart extends AbstractChart
{
    protected function chartTitle(): string
    {
        return 'Month Chart';
    }

    protected function chartType(): string
    {
        return VerticalBarChart::class;
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
    
    /**
    * Custom options
    * 
    * @override method
    * @return string
    */
    protected function options(){
        // json string options
        return "{
            responsive : false,
            plugins    : {
                legend : {
                    display  : true,
                    position : 'top',
                },
                title  : {
                    text     : 'Custom Title',
                    position : 'top',
                    display  : true,
                    color    : 'black',
                },
            },
        }";
    }
}
```
**In controller: now use the class in the controller**
```php
use App\Charts\MonthlyCompletionChart;

class ChartController extends Controller {
    public function index(){
        $chart = new MonthlyCompletionChart();
        
        return view('charts.report')->with('chart',$chart->template());
    }
}
```
### 2. Or, Generate chart by service

```php
use RadiateCode\DaChartjs\Types\Bar\VerticalBarChart;
use RadiateCode\DaChartjs\Chart;

class ReportController extends Controller {
    public function index()
    {  
        $datasets = [
            Dataset::general('Project',[20, 30,55])->make(),
            Dataset::general('Task',[50, 80,44])->make(),
            Dataset::general('Issue',[70, 75,99])->make(),
        ];
        
        /**
        * ------------------
        * create chart
        * -----------------
        */
        $barChart = (new Chart('Monthly Chart', VerticalBarChart::class))
            ->changeDefaultOption('plugins.title.text','Monthly Project, Task And Issue Chart')
            ->changeDefaultOption('plugins.title.color','blue')
            ->labels(['January', 'February','March'])
            ->datasets($datasets)
            // custom json string options
            ->options("{
                responsive : false,
                plugins    : {
                    legend : {
                        display  : true,
                        position : 'top',
                    },
                    title  : {
                        text     : 'New Title',
                        position : 'top',
                        display  : true,
                        color    : 'black',
                    },
                },
            }")
            ->template();    
              
        return view('charts.report')->with('chart',$barChart);       
    }
}
```
## Front-End configuration
**In view (blade) file:**
```html
<div class="chart">
    <div class="chart">
        <!-- generate chart canvas html -->
        {!! $chart->chartHtml() !!}
    </div>
</div>

......

<!-- generate chart.js CDN -->
{!! $chart->chartLibraries() !!}

<!-- generate configured chart script -->
{!! $chart->chartScripts() !!}
```