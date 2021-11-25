## Examples Html Builder
### Load chart data and update chart by filters
**Configuration:**
```php
class ReportController extends Controller {
    public function index(){
            /**
            * --------------------------------------
            * generate chart with default options 
            * --------------------------------------
            */
            $barChart = (new Chart('Top Sales Chart', HorizontalBarChart::class))
                ->labels([])
                ->datasets([])
                ->template();    
                  
            return view('dashboard')->with('chart',$barChart);       
    }
}
```
> Note: **datasets([])** & **labels([])** are empty because these values will be loaded by ajax

**In view file:**
```html
<div class="chart">
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
{!! $chart->apiChartScript(url('fetch/top/sales/chart'), 'search-btn', "start_date","end_date")) !!}
```
**Api Route & Response:**

```php
Route::get('fetch/top/sales/chart','ChartController@topSalesData');

............
use \RadiateCode\DaChart\Response\ChartResponse;

class ChartController {
    public function topSalesData(Request $request){
        // place db query to fetch data form db
        $sales = Sale::whereBetween('date',[$request->get('start_date'),$request->get('end_date')])
                    ->orderBy('total_volume', 'desc')
                    ->groupBy('order_products.product_id')
                    ->selectRaw('product_name,SUM(product_sold_quantity) as total_volume')
                    ->get();
       
       $labels = $sales->pluck('product_name')->toArray();
       
       $datasets = [
            Dataset::label('Sales')
                ->data($sales->pluck('total_volume')->toArray())
                ->backgroundColor('green')
                ->borderColor('black')->make(),
        ];
        
        return (new ChartResponse())
                ->labels($labels)
                ->datasets($datasets)
                ->toJson();
    }
}
```