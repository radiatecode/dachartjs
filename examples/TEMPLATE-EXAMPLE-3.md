# Examples of Html builder: apiChartScripts()
**Load chart data and update chart based on inputs**
## Back-End Configuration
In both ways we will configure chart, chose either one.
### 1. Generate chart by dedicated class
    php artisan make:dachartjs ProjectCharts
```php
namespace App\Charts;

use RadiateCode\DaChartjs\Abstracts\AbstractChart;
use RadiateCode\DaChartjs\Types\Bar\HorizontalBarChart;

class ProjectCharts extends AbstractChart
{
    protected function chartTitle(): string
    {
        return 'Project Charts';
    }

    protected function chartType(): string
    {
        return HorizontalBarChart::class;
    }

    protected function labels(): array
    {
        return []; // empty labels, will be loaded by ajax
    }

    protected function datasets(): array
    {
        return []; // empty datasets, will be loaded by ajax
    }
    
    protected function chartSize(): array
    {
        return [
            'height' => 250
        ];
    }
}
```
> Note: **datasets() and labels()** are empty because these data will be loaded by ajax.

**In controller: now use the class in the controller**
```php
use App\Charts\ProjectCharts;

class ChartController extends Controller {
    public function index(){
        $chart = new ProjectCharts();
        
        return view('charts.report')->with('chart',$chart->template());
    }
}
```
### 2. Or, Generate chart by service

```php
use RadiateCode\DaChartjs\Chart;
use RadiateCode\DaChartjs\Types\Bar\HorizontalBarChart;

class ReportController extends Controller {
    public function index()
    {
        $barChart = (new Chart('Project Charts', HorizontalBarChart::class))
            ->labels([]) // empty labels, will be loaded by ajax
            ->datasets([]) // empty datasets, will be loaded by ajax
            ->template();    
              
        return view('dashboard')->with('chart',$barChart);       
    }
}
```
### Api Route
```php
Route::post('project/charts','ChartController@projectCharts');
```
### Api Response
```php
use \RadiateCode\DaChartjs\Facades\ChartResponse;

class ChartController {
    public function projectCharts(Request $request)
    {
        // default dates
        $start_date = date('Y-m')."-"."01";
        $end_date   = date("Y-m-t");

        // replace default dates with user inputs
        if ($request->has('start_date') && $request->has('end_date')) {
            $start_date = $request->get('start_date');
            $end_date   = $request->get('end_date');
        }
        
       $projectPending = Project::where('status','pending')
                   ->whereBetween('date',[$start_date,$end_date])
                   ->count();
                   
       $projectCompleted = Project::where('status','completed')
                   ->whereBetween('date',[$start_date,$end_date])
                   ->count();
                   
       $taskPending = Task::where('status','pending')
                   ->whereBetween('date',[$start_date,$end_date])
                   ->count();
       
       $taskCompleted = Task::where('status','completed')
                   ->whereBetween('date',[$start_date,$end_date])
                   ->count();
       
       $datasets = [
            Dataset::label('Completed')
                ->data([$projectCompleted,$taskCompleted])
                ->backgroundColor('green')
                ->borderColor('black')->make(),
            Dataset::label('Pending')
                ->data([$projectPending,$taskPending])
                ->backgroundColor('green')
                ->borderColor('black')->make(),
        ];
        
        return ChartResponse::labels(['Projects','Tasks'])->datasets($datasets)->toJson();
    }
}
```
## Front-End configuration
**In view file:**
```html
<div class="row">
    <input type="text" id="start_date" class="form-control datepicker" placeholder="" aria-label="">
    <input type="text" id="end_date" class="form-control datepicker" placeholder="" aria-label="">
    <button class="btn btn-primary" id="search-btn" type="button">
        <i class="fa fa-search-plus"></i> Search
    </button>
    <div class="chart">
        <!-- generate chart canvas html -->
        {!! $chart->chartHtml() !!}
    </div>
</div>

......

<!-- generate chart.js CDN -->
{!! $chart->chartLibraries() !!}

<!-- update or refresh by firing an event -->
{!! $chart->apiChartScripts([
    'url' => url('project/charts'),
    'type' => 'POST',
    'headers' => [
        'X-CSRF-TOKEN' => csrf_token()
    ]
], 'search-btn', ["start_date","end_date"]) !!}
```
> When **'search-btn'** is clicked it get values from start_date, end_date inputs and update the chart based on inputs.
> Input ids used as http request key to get data in the back-end (**e:g; $request->get('start_date'), $request->get('end_date')**) 

> **Note:** If your route need authorization then make sure you added Authorization header
> ```html
> $chart->apiChartScripts([
>     'url' => url('project/charts'), 
>     'type' => 'POST',
>     'headers' => [
>         'X-CSRF-TOKEN' => csrf_token(),
>         'Authorization' => 'Bearer someauthorizedtoken'
>     ]
> ])
> ```