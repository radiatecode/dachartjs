## Examples Html Builder
### Load chart data and update chart by filters
**Configuration:**
```php
class ReportController extends Controller {
    public function index()
    {
        $barChart = (new Chart('Top Sales Chart', HorizontalBarChart::class))
            ->labels([])
            ->datasets([])
            ->template();    
              
        return view('dashboard')->with('chart',$barChart);       
    }
}
```
> Note: **datasets** & **labels** are empty because these values will be loaded by ajax

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
{!! $chart->chartLibrary() !!}

<!-- use it when chart need to update or refresh by firing an event -->
{!! $chart->apiChartScript(url('project/charts'), 'search-btn', "start_date","end_date")) !!}
```
> When **'search-btn'** is clicked it get values from start_date, end_date inputs and attach
> the values as query string like **http://demo.test/project/charts?start_date=2021-11-01&end_date=2021-11-30**

**Api Route:**

```php
Route::get('project/charts','ChartController@projectCharts');
```
**Response:**

```php
............
use \RadiateCode\DaChart\Facades\ChartResponse;

class ChartController {
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