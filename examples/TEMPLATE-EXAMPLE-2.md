## Examples Html Builder
#### Load chart data by ajax
**Configuration:**
```php
class ReportController extends Controller {
    public function index()
    {
        $barChart = (new Chart('Top Sales Chart', HorizontalBarChart::class))
            ->labels(['January','February','March']) // fixed labels
            ->datasets([])
//                ->options([
//                        'responsive' => false,
//                        'plugins'    => [
//                            'legend' => [
//                                'display'  => true,
//                                'position' => 'top',
//                            ],
//                            'title'  => [
//                                'text'     => 'Custom Title',
//                                'position' => 'top',
//                                'display'  => true,
//                                'color'    => 'black',
//                            ],
//                        ],
//                ])
            ->template();    
              
        return view('dashboard')->with('chart',$barChart);       
    }
}
```
> Note: **datasets([])** is empty because the datasets will be loaded by ajax.

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

<!-- use it when you need to load chart data by ajax -->
{!! $chart->apiChartScript(url('fetch/monthly/top/sales/chart'))) !!}
```
**Api Route:**

```php
Route::get('fetch/monthly/top/sales/chart','ChartController@topSalesMonthly');

```
**Api Response:**

For api response we can use **ChartResponse**
```php
............

use RadiateCode\DaChart\Facades\ChartResponse;

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
        
        return ChartResponse::datasets($datasets)->toJson();
    }
}
```