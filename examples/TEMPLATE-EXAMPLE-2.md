# Examples of Html builder: apiChartScripts()
**Load chart data by ajax**
## Back-End Configuration
In both ways we will configure chart, chose either one.
### 1. Generate chart by dedicated class
    php artisan make:dachartjs TopSalesChart
```php
namespace App\Charts;

use RadiateCode\DaChartjs\Abstracts\AbstractChart;
use RadiateCode\DaChartjs\Types\Bar\HorizontalBarChart;

class TopSalesChart extends AbstractChart
{
    protected function chartTitle(): string
    {
        return 'Top Sales Chart';
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
    
    /**
    * Change default options when necessary
    * 
    * @override method
    * @return array
    */
    protected function changeDefaultOptions(): array
    {
        return [
            'plugins.title.text' => 'Monthly Project, Task And Issue Chart',
            'plugins.title.color' => 'red'
        ];
    }
}
```
> Note: **datasets() and labels()** are empty because these data will be loaded by ajax.

**In controller: now use the class in the controller**
```php
use App\Charts\TopSalesChart;

class ChartController extends Controller {
    public function index(){
        $chart = new TopSalesChart();
        
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
        $chart = (new Chart('Top Sales Chart', HorizontalBarChart::class))->template();    
              
        return view('charts.report')->with('salesChart',$chart);    
    }
}
```
> Note: **datasets() and labels()** are missing because these will be loaded by ajax.
### Api Route
```php
Route::get('fetch/monthly/top/sales/chart','ChartController@topSalesMonthly');
```
### Api Response
For api response we used **ChartResponse**
```php
use RadiateCode\DaChartjs\Facades\ChartResponse;
use RadiateCode\DaChartjs\Facades\Dataset;

class ChartController {
    public function topSalesMonthly(Request $request){
        // place db query to fetch data form db
        $sales = Sale::groupBy('month')
                    ->selectRaw('SUM(product_sold_quantity) as total_volume')
                    ->pluck('total_volume')
                    ->toArray();
                    
        
        $datasets = [
            Dataset::label('Sales')
                ->data($sales)
                ->backgroundColor('green')
                ->borderColor('black')->make(),
        ];
        
        return ChartResponse::labels(['Jan','Feb','March'])->datasets($datasets)->toJson();
    }
}
```
## Front-End configuration
**In view (blade) file:**
```html
<div class="chart">
    <div class="chart">
        <!-- generate chart canvas html -->
        {!! $salesChart->chartHtml() !!}
    </div>
</div>

......

<!-- generate chart.js CDN -->
{!! $salesChart->chartLibraries() !!}

<!-- load chart -->
{!! $salesChart->apiChartScripts(url('fetch/monthly/top/sales/chart')) !!}
```
> **Note:** by default AJAX type is **GET** when you pass only url to apiChartScripts.

> **Note:** If you want more control then pass an array of ajax options
> ```html
> $salesChart->apiChartScripts([
>     'url' => url('fetch/monthly/top/sales/chart'), 
>     'type' => 'GET',
>     'headers' => [
>         'Authorization' => 'Bearer someauthorizedtoken'
>     ]
> ])
> ```
