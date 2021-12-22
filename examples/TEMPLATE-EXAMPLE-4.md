### Examples of API Chart Script using dedicated chart class
Create a chart class
```php
namespace App\Charts;

use RadiateCode\DaChartjs\Abstracts\AbstractChart;
use RadiateCode\DaChartjs\Types\Bar\HorizontalBarChart;

class MonthlyCompletionChart extends AbstractChart
{
	/**
     * Chart title
     *
     * ---------------------------------------------------------------------
     * Note: it can be use as chart id or chart name in js & html
     * ---------------------------------------------------------------------
     *
     * @return string
     */
    protected function chartTitle(): string
    {
        return 'Month Chart';
    }

	/**
     * Chart type
     *
     * ---------------------------------------------------------------------
     * Note: Chart type must be path of a concrete class of TypeInterface
     * [ex: HorizontalBarChart::class]
     * ---------------------------------------------------------------------
     *
     * @return string
     */
    protected function chartType(): string
    {
        return HorizontalBarChart::class;
    }

    /**
     * Chart labels
     *
     * @return array
     */
    protected function labels(): array
    {
        return [];
    }

    /**
     * Dataset
     *
     * @return array
     */
    protected function datasets(): array
    {
        return [];
    }
    
    /**
     * Change default options when necessary
     *
     * @return array
     */
    protected function changeDefaultOptions(): array
    {
        return [
            'plugins.title.text' => 'Monthly Completion Chart',
            'plugins.title.color' => 'red',
        ];
    }
}
```
> Note: **datasets** & **labels** methods are empty because these values will be loaded by ajax

**In controller:**

Use the dedicated chart class in the controller
```php
use App\Charts\MonthlyCompletionChart;

class ReportController extends Controller
{
    .........................

    public function monthlyChart(){
        $myChart =  new MonthlyCompletionChart();
        
        //return view('dashboard')->with('monthlyChart',$myChart->render());
        return view('report')->with('myChart',$myChart->template());
    }
}
```
**In view (blade) file:**
```html
<div class="row">
    <input type="text" id="start_date" class="form-control datepicker" placeholder="" aria-label="">
    <input type="text" id="end_date" class="form-control datepicker" placeholder="" aria-label="">
    <button class="btn btn-primary" id="search-btn" type="button">
        <i class="fa fa-search-plus"></i> Search
    </button>
    <div class="chart">
        <!-- generate chart html canvas -->
        {!! $myChart->chartHtml() !!}
    </div>
</div>

......

<!-- generate chart.js CDN -->
{!! $myChart->chartLibraries() !!}

<!-- generate configured api chart script -->
{!! $chart->apiChartScripts(url('project/charts'), 'search-btn', "start_date","end_date")) !!}
```
**Api Route:**

```php
Route::get('project/charts','ChartController@projectCharts');
```
**Api Response:**

```php
............
use \RadiateCode\DaChartjs\Facades\ChartResponse;
use \RadiateCode\DaChartjs\Facades\Dataset;

class ChartController 
{
    public function projectCharts(Request $request)
    {
       $projectPending = Project::where('status','pending')
                   ->whereBetween('date',[$request->get('start_date'),$request->get('end_date')])
                   ->count();
                   
       $projectCompleted = Project::where('status','completed')
                   ->whereBetween('date',[$request->get('start_date'),$request->get('end_date')])
                   ->count();
                   
       $taskPending = Task::where('status','pending')
                   ->whereBetween('date',[$request->get('start_date'),$request->get('end_date')])
                   ->count();
       
       $taskCompleted = Task::where('status','completed')
                   ->whereBetween('date',[$request->get('start_date'),$request->get('end_date')])
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