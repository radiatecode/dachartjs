# Da Chart
![Stats](img/da-chart.png)

The package used to generate charts in Laravel without implementing javascript in the front-side. It is used as a back-end service of [chart js](https://www.chartjs.org).
It will dynamically render HTML & JS configuration.

## Examples
### Example 1: Monthly Project, Task and Issue Completion Chart
![Stats](img/example-1.png)

**Configuration:**
```php
use RadiateCode\DaChart\Chart;
use RadiateCode\DaChart\Facades\Dataset;
use RadiateCode\DaChart\Types\Bar\VerticalBarChart;

class ReportController extends Controller 
{
    .........................
        
    public function monthlyChart(){
        $datasets = [
            Dataset::label('Task')->data([20, 30,55])->backgroundColor('yellow')
                ->borderColor('black')->make(),
            Dataset::label('Project')->data([50, 80,44])->backgroundColor('green')
                ->borderColor('white')->make(),
            Dataset::label('Issue')->data([70, 75,99])->backgroundColor('red')
                ->borderColor('white')->make(),
        ];
    
        $monthlyChart = (new Chart('Monthly Chart', VerticalBarChart::class))
                ->labels(['January', 'February','March'])
                ->datasets($datasets)
                ->template();
        
        return view('reports.monthly')->with('monthlyChart',$monthlyChart);
    }
}
```
**In view (blade) file:**
```html
<div class="chart">
    <!-- generate chart html canvas -->
    {!! $monthlyChart->chartHtml() !!}
</div>

......
<!-- generate chart js and dependents CDN script -->
{!! $monthlyChart->chartLibraries() !!}
<!-- generate chart configured scripts -->
{!! $monthlyChart->chartScript() !!}
```
### Example 2: API or AJAX Chart
![Stats](img/example-2.png)

The chart shows top sales products according to the month selection.

**Code:**

**Configuration in controller:**
```php
use RadiateCode\DaChart\Chart;
use RadiateCode\DaChart\Types\Bar\VerticalBarChart;

class ReportController extends Controller 
{
    .........................
    public function salesChart(){
        $monthlyChart = (new Chart('Monthly Sales Chart', VerticalBarChart::class))
                ->datasets([]) // empty datasets
                ->template();
        
        return view('reports.top_sales')->with('monthlyChart',$monthlyChart);
    }
}
```
**In blade file:**
```html
<div class="chart">
    <input type="text" id="month_name" class="form-control month" placeholder="" aria-label="">
    <button class="btn btn-primary" id="search-btn" type="button">
        <i class="fa fa-search-plus"></i>
    </button>
    <!-- generate chart html canvas -->
    {!! $monthlyChart->chartHtml() !!}
</div>

......
<!-- generate chart js and dependents CDN script -->
{!! $monthlyChart->chartLibraries() !!}
<!-- generate ajax chart scripts -->
{!! $monthlyChart->apiChartScript(url('fetch/monthly/top/sales/chart'), 'search-btn', "month_name")) !!}
```
> When "search-btn" is triggered it will get value from input element of month, 
> attach the value with the given url as query string and send request to server to fetch data.

**Api Route:**

```php
Route::get('fetch/monthly/top/sales/chart','ReportController@monthlyTopSales');
```
**Api Response:**
```php
............
use RadiateCode\DaChart\Facades\Dataset;
use RadiateCode\DaChart\Facades\ChartResponse;
use RadiateCode\DaChart\Enums\ChartColor;
use App\Models\Order;

class ReportController extends Controller 
{
    public function monthlyTopSales(Request $request)
    {
        $sales = Order::where('month',$request->get('month_name'))
                        ->orderBy('sold_qty','desc')
                        ->groupBy('product_id')
                        ->selectRaw('product_name, SUM(qty) as sold_qty')
                        ->take(4)->get();
                        
         $soldProducts = $sales->pluck('product_name')->toArray();
         $soldQty = $sales->pluck('sold_qty')->toArray();
    
         $datasets = [
            Dataset::label('Top Sales')
                ->data($soldQty)
                ->backgroundColor([
                    ChartColor::LIGHT_SLATE_BLUE,
                    ChartColor::BRIGHT_TURQUOISE,
                    ChartColor::ELECTRIC_PURPLE,
                    ChartColor::EGGPLANT
                ])->make(),
        ];
        
        return ChartResponse::labels($soldProducts)->datasets($datasets)->toJson();
    }
}
```
# Requirements
- [PHP >= 7.0](https://www.php.net/)
- [Laravel 5.2-5.8|6.x|7.x|8.x](https://github.com/laravel/framework)
- [Chart Js](https://www.chartjs.org/)
# Installation
You can install the package via composer:

    composer require radiatecode/dachart
### Register Service Provider (Optional on Laravel 5.5+)
Register provider on your config/app.php file.
```php
'providers' => [
    ...,
    RadiateCode\DaChart\ChartServiceProvider::class,
]
```

# Usages
In two ways you can generate chart such as
- [Generate by ***Chart*** class](#generate-by-chart-class)
- Or, [Generate by dedicated class](#generate-chart-by-dedicated-class).

## Generate by Chart class

```php
$barChart = new Chart('Monthly Chart', HorizontalBarChart::class);
```
> 
> ***Note: 2nd arg is [type of chart](#chart-types)***. 

### Available Methods of Chart object:
#### labels()
labeling the data index of the chart. it could be x-axis or y-axis, by default it is x-axis.
```php
$barChart->labels(['January', 'February','March'])
```
> labels axis change by **indexAxis** property which used in the **options** configuration
#### datasets()

```php
$barChart->datasets([])
```
> Datasets can be build by **Dataset Facades**

Example:
```php
 $datasets = [
    Dataset::label('Task')->data([20, 30,55])->backgroundColor('yellow')
        ->borderColor('black')->make(),
    Dataset::label('Project')->data([50, 80,44])->backgroundColor('green')
        ->borderColor('white')->make(),
    Dataset::label('Issue')->data([70, 75,99])->backgroundColor('red')
        ->borderColor('white')->make(),
];
        
$barChart->datasets($datasets);
```
> Or datasets can be configured as manual

Example:
```php
 $datasets = [
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
];
        
$barChart->datasets($datasets);
```
#### changeDefaultOption() [Optional]
Every type of chart has a dedicated class, and each type of chart class comes with predefined options. For example see the **defaultOptions()** methods of **[HorizontalBarChart](src/Types/Bar/HorizontalBarChart.php)** , **[MultiAxisLineChart](src/Types/Line/MultiAxisLineChart.php)**

So, in some scenario you may need to update the values of default options. In that case you can use **changeDefaultOption('optionKey','value')**

```php
$barChart->changeDefaultOption('plugins.title.text','Monthly Project, Task And Issue Chart')
```
> Note: dot used in key arg to indicate the nested level of the options

For multiple modification you can chain the method as we needs
```php
$barChart->changeDefaultOption('plugins.title.text','Monthly Project, Task And Issue Chart')
        ->changeDefaultOption('plugins.title.color','blue')
```
#### options() [Optional]
If you don't want to use default options then use your custom options

Options could be **php array** format
```php
$barChart->options([
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
```
Or, you can pass **json string** format
```php
$barChart->options("{
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
    }")
```
> To know more about the **options** properties see chart js official [documentation](https://www.chartjs.org/docs/latest).

#### render()
Render method will return array of chart configurations. The configuration later can be manually used in javascript
```php
$barChart->render();
```
#### Check the sample code [here](examples/RENDER-EXAMPLE.md)

#### template()
If you don't want to setup javascript manually in view file then use **template()** instead of **render()**
```php
$barChart->template();
```
> **Template method return a html builder instance.**
#### Methods of html builder
 - **chartHtml()** : generate html canvas tag
 - **chartLibraries()** : generate the chart.js CDN and chart plugins libraries (if plugin integrate)
 - **chartScript()** : generate back-end configured chart scripts
   > **Check the sample code [here](examples/TEMPLATE-EXAMPLE-1.md)**
 - **apiChartScript($url, $fireEventElementId = null, ...$filterElementIds)** : generate back-end configured chart and ajax scripts. It loads chart data & labels via ajax. 
    It also allows update or refresh the chart via firing click event.
    > **For api chart response you have to use [ChartResponse Facade](src/Facades/ChartResponse.php)**
   
    >  If you just want to load chart data by ajax then only pass value to 1st argument. 
    >> **Check the sample Code [here](examples/TEMPLATE-EXAMPLE-2.md)**

    > If you want to update the chart based on some input values then you have to pass a trigger ID in the 2nd argument and input IDs 
    in the 3rd argument. 
    >> **Check the sample Code [here](examples/TEMPLATE-EXAMPLE-3.md)**
   
## Generate chart by dedicated class
Run the command to create a chart class

    php artisan make:dachart MonthlyCompletionChart
This will create a dedicated chart class under **App\Charts** namespace.

### Sample Code:
```php
namespace App\Charts;

use RadiateCode\DaChart\Abstracts\AbstractChart;
use RadiateCode\DaChart\Facades\Dataset;
use RadiateCode\DaChart\Types\Bar\HorizontalBarChart;

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
     * ---------------------------------------------------------------------------------
     * Note: This labels are used to label the data index (default x axis) in the chart view
     * ---------------------------------------------------------------------------------
     *
     * @return array
     */
    protected function labels(): array
    {
        return [
            'January',
            'February',
            'March'
        ];
    }

	/**
     * Dataset
     *
     * -------------------------------------------------------------------------------------------------
     * Note: datasets can be generate by Dataset Facade 
     * Or, we can pass custom array with dataset properties,
     * -------------------------------------------------------------------------------------------------
     *
     * @return array
     */
    protected function datasets(): array
    {
        return [
            Dataset::general('Project',[20, 30,55])->make(),
            Dataset::general('Task',[50, 80,44])->make(),
            Dataset::general('Task',[70, 75,99])->make()
        ];
    }
}
```
> **Note:** If you want to change chart default options then **override** ***changeDefaultOptions()***
> 
> See the sample below
> ```php
> class MonthlyCompletionChart extends AbstractChart
> {
>     /**
>     * Change default options when necessary
>     *
>     * @override method
>     * @return array
>     */  
>     protected function changeDefaultOptions(): array
>     {
>         return [
>              // dot used in key is to indicate nested level of option properties
>             'plugins.title.text' => 'Monthly Completion Chart',
>             'plugins.title.color' => 'red',
>         ];
>     }
> }
> ```
> Or, if you want to provide custom options instead of default options then **override** ***options()***. See the sample below
> ```php
> class MonthlyCompletionChart extends AbstractChart
> {
>     /**
>     * Use custom options if we don't want to use defaults
>     *
>     * @override method
>     * @return array|string
>     */  
>     protected function options()
>     {
>          return [
>                 'responsive' => true,
>                 'scales' => [
>                     'xAxes' => [
>                         'ticks' => [
>                             'beginAtZero' => true,
>                             'maxRotation' => 90,
>                             'minRotation' => 90
>                         ]
>                     ]
>                 ],
>                 'plugins'    => [
>                     'title'  => [
>                         'text'     => 'My Chart Title',
>                         'position' => 'top',
>                         'display'  => true,
>                         'color'    => 'yellow',
>                     ],
>                 ]
>             ];
>            
>            /** 
>            * Json string can be use
>            */
>    
>            // return "{
>            //   responsive : true,
>            //   plugins    : {
>            //       title  : {
>            //           text     : 'My Chart Title',
>            //           position : 'top',
>            //           display  : true,
>            //           color    : 'yellow',
>            //       },
>            //  },
>            // }"
>     }
> }
> ```
**In controller:**

After all the configuration you can use the dedicated class in the controller
```php
use App\Charts\MonthlyCompletionChart;

class ReportController extends Controller
{
    .........................

    public function monthlyChart(){
        $myChart =  new MonthlyCompletionChart();
        
        return view('reports.monthly')->with('myChart',$myChart->template());
    }
}
```
> Dedicated chart class object provides two methods
> - **render():** Render method return array of chart configurations
> - **template():** Template method return a [html builder instance](#methods-of-html-builder)

**In view (blade) file:**
```html
<div class="chart">
    <div class="chart">
        <!-- generate chart html canvas -->
        {!! $myChart->chartHtml() !!}
    </div>
</div>

......

<!-- generate chart.js and any dependents CDN scripts-->
{!! $myChart->chartLibraries() !!}

<!-- generate configured chart script -->
{!! $myChart->chartScript() !!}
```
> See sample code [here](examples/TEMPLATE-EXAMPLE-4.md) if you want to use api chart script using dedicated chart class
## Chart Types
There are various predefined types of chart (configured) available such as
#### Bar chart
- **[Horizontal Bar Chart](src/Types/Bar/HorizontalBarChart.php)**
- **[Stacked Bar Chart](src/Types/Bar/StackedBarChart.php)**
- **[Vertical Bar Chart](src/Types/Bar/VerticalBarChart.php)**
#### Line chart
- **[Interpolation Line Chart](src/Types/Line/InterpolationLineChart.php)**
- **[Line Chart](src/Types/Line/LineChart.php)**
- **[Multi Axis Line Chart](src/Types/Line/MultiAxisLineChart.php)**
- **[Stepped Line Chart](src/Types/Line/SteppedLineChart.php)**
#### [Bubble chart](src/Types/Bubble/BubbleChart.php)
#### [Pie chart](src/Types/Pie/PieChart.php)
#### [Doughnut chart](src/Types/Doughnut/DoughnutChart.php)
#### [Polar Area Chart](src/Types/PolarArea/PolarAreaChart.php)
#### [Radar Chart](src/Types/Radar/RadarChart.php)
#### [Scatter Chart](src/Types/Scatter/ScatterChart.php)

> You can create your own custom type by extending **[BaseChartType](src/Abstracts/AbstractChart.php)**. Namespace could be **App\Charts\Types** (create Charts\Types folder inside the app folder)
## Dataset Facade
Dataset Facade can be helpful to generate datasets for chart, each dataset has various properties such as label, background color, border color, data, fill, boarder width etc.
Above examples or sample code shows that how to generate datasets by using **Dataset Facade**
### Methods
See the available [methods](src/Contracts/DatasetInterface.php) of Dataset Facade

## Dedicated Dataset Class (Suggestion)
If you create a chart with multiple datasets which depends on multiple db query then it would be nicer to create a separate dataset class in order to increase the readability, maintainability of the code

> Namespace could be **App\Charts\Datasets** (create Charts\Datasets folder inside the app folder)

**Check the sample code [here](examples/DATASET-EXAMPLE.md)**

## Plugin Integration (Optional)
Sometimes we need extra plugin to manipulate chart, so in that case we can integrate plugins in our charts

## Contributing
Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security
If you discover any security related issues, please email [radiate126@gmail.com](mailto:radiate126@gmail.com) instead of using the issue tracker.

## Credits
- [Noor Alam](https://github.com/radiatecode)
- [All Contributors](https://github.com/radiatecode/dachart/contributors)


## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

