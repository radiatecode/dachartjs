## Examples Html Builder
### Usage of chartScripts()
**Configuration:**
```php
use RadiateCode\DaChartjs\Types\Bar\VerticalBarChart;

class ReportController extends Controller {
    public function index(){
        /**
        * --------------------------------------
        * Dataset configure manually
        * --------------------------------------
        */
        $datasets = [
            [
                "label"           => "Task",
                "backgroundColor" => "yellow",
                "data"            => [50,70,90], 
                "borderColor"     => "yellow",
            ],
            [
                "label"           => "Project",
                "backgroundColor" => "green",
                "data"            => [25,55,80],
                "borderColor"     => "green",
            ],
            [
                "label"           => "Issue",
                "backgroundColor" => "red",
                "data"            => [33,90,99],
                "borderColor"     => "red",
            ],
        ];
        
        /**
        * --------------------------------------
        * create chart with modification of default options 
        * --------------------------------------
        */
        $barChart = (new Chart('Monthly Chart', VerticalBarChart::class))
            ->changeDefaultOption('plugins.title.text','Monthly Project, Task And Issue Chart')
            ->changeDefaultOption('plugins.title.color','blue')
            ->labels(['January', 'February','March'])
            ->datasets($datasets)
            ->template();    
              
        return view('dashboard')->with('chart',$barChart);       
    }
}
```
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