# Da Chart
![Stats](img/da-chart.png)

This package used to generate chart for chart js and doesn't need to configure javascript in the front side.
It will render HTML & JS configuration to view the chart.

## Examples
**Example 1: Monthly Project, Task and Issue Completion Chart** 

In controller:
```php
use RadiateCode\DaChart\Chart;
use RadiateCode\DaChart\Facades\Dataset;
use RadiateCode\DaChart\Types\Bar\HorizontalBarChart;
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

    $monthlyChart = (new Chart('Monthly Chart', HorizontalBarChart::class))
            ->labels(['January', 'February','March'])
            ->datasets($datasets)
            ->template();
    
    return view('dashboard')->with('monthlyChart',$monthlyChart);
}
```
In blade file:
```html
<div class="chart">
    <!-- generate chart canvas html -->
    {!! $chart->chartHtml() !!}
</div>

......
<!-- generate chart scripts -->
{!! $chart->chartLibrary() !!}
{!! $chart->chartScript() !!}
```
***Output:***
![Stats](img/example-1.png)
> Or we can create a dedicated chart class to generate the above chart.

**Chart class:**
```php
namespace App\Chart;

use RadiateCode\DaChart\Abstracts\AbstractChart;
use RadiateCode\DaChart\Facades\Dataset;
use RadiateCode\DaChart\Types\Bar\HorizontalBarChart;

class MonthlyChart extends AbstractChart
{

    protected function chartTitle(): string
    {
        return 'Monthly Chart';
    }

    protected function chartType(): string
    {
        return HorizontalBarChart::class;
    }

    protected function labels(): array
    {
        return [
            'January',
            'February',
            'March'
        ];
    }

    protected function datasets(): array
    {
        return [
            Dataset::label('Task')->data([20, 30,55])->backgroundColor('yellow')
                ->borderColor('black')->make(),
            Dataset::label('Project')->data([50, 80,44])->backgroundColor('green')
                ->borderColor('white')->make(),
            Dataset::label('Issue')->data([70, 75,99])->backgroundColor('red')
                ->borderColor('white')->make(),
        ];
    }
}
```
In Controller:
```php
use App\Chart\MonthlyChart;
.............

public function monthlyChart(){
    $chart = new MonthlyChart();

    return view('client.welcome')->with('chart',$chart->template());
}
```