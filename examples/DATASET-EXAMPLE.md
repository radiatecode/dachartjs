
## Dedicate Dataset Class
```php
namespace App\Charts\Datasets;

use RadiateCode\DaChartjs\Facades\Dataset;

class MonthlyCompletionDataset 
{
    public function projectCompletions(): array
    {
        $projects = Project::where('status','completed')
        ->groupBy('month')
        ->selectRaw('count(*) as number, month')
        ->pluck('number')->toArray();
        
        return Dataset::general('project',$projects,'green','light-green')->make();
    }
    
    public function taskCompletions(): array
    {
        $tasks = Task::where('status','completed')
        ->groupBy('month')
        ->selectRaw('count(*) as number, month')
        ->pluck('number')->toArray();
        
        return Dataset::general('task',$tasks,'blue','blue')->make();
    }
    
     public function issueCompletions(): array
     {
        $issues = Issue::where('status','completed')
        ->groupBy('month')
        ->selectRaw('count(*) as number, month')
        ->pluck('number')->toArray();
        
        return Dataset::general('issue',$issues,'red','red')->make();
    }
    
    public function datasets(): array 
    {
        return [
            $this->projectCompletions(),
            $this->taskCompletions(),
            $this->issueCompletions()
        ];
    }
}
```
### Use it in controller:
```php
use App\Charts\Datasets\MonthlyCompletionDataset;

class ReportController extends Controller
{
    .........................

    public function monthlyChart(){
        $datasets = (new MonthlyCompletionDataset())->datasets();
        
        $barChart = (new Chart('Monthly Chart', HorizontalBarChart::class))
                ->labels(['January', 'February','March'])
                ->datasets($datasets)
                ->template();    
        
        //return view('dashboard')->with('monthlyChart',$monthlyChart->render());
        return view('dashboard')->with('monthlyChart',$barChart);
    }
}
```
### Or, use it in dedicated chart class:

```php
<?php

namespace App\Charts;

use RadiateCode\DaChartjs\Abstracts\AbstractChart;
use App\Charts\Datasets\MonthlyCompletionDataset;
use RadiateCode\DaChartjs\Types\Bar\HorizontalBarChart;

class MonthlyCompletionChart extends AbstractChart
{
	/**
     * Chart title
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
        return [
            'January',
            'February',
            'March'
        ];
    }

	/**
     * Dataset
     *
     * @return array
     */
    protected function datasets(): array
    {
        return (new MonthlyCompletionDataset())->datasets();
    }
    
    /**
     * Change default options when necessary
     *
     * @return array
     */
    protected function changeDefaultOptions(): array
    {
        return [
            'plugins.title.text' => 'Completion Chart',
            'plugins.title.color' => 'black',
        ];
    }
    
    /**
     * Use custom options when we don't want to use the default. 
     * 
     * @return array
     */
    protected function options(): array
    {
        return [];
    }
}
```
### Or, use it in api chart response

```php
............
use \RadiateCode\DaChartjs\Facades\ChartResponse;

class ChartController {
    public function projectCharts(Request $request)
    {
        $data = new MonthlyCompletionDataset();
         
        return ChartResponse::labels(['January','February', 'March'])->datasets($data->datasets())->toJson();
    }
}
```