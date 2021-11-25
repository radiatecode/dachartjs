## Example of render()
**Back-End Configuration:**
```php
class WelcomeController extends Controller {
    public function index(){
            /**
            * --------------------------------------
            * 1. Dataset configure with Dataset Facades
            * --------------------------------------
            */
            $datasets = [
                Dataset::label('Task')->data([20, 30,55])->backgroundColor('yellow')
                    ->borderColor('black')->make(),
                Dataset::label('Project')->data([50, 80,44])->backgroundColor('green')
                    ->borderColor('white')->make(),
                Dataset::label('Issue')->data([70, 75,99])->backgroundColor('red')
                    ->borderColor('white')->make(),
            ];
            
            /**
            * --------------------------------------
            * 2. Dataset configure manually
            * --------------------------------------
            */
//            $datasets = [
//                [
//                    "label"           => "Task",
//                    "backgroundColor" => "yellow",
//                    "data"            => [20, 30,55],
//                    "borderColor"     => "yellow",
//                ],
//                [
//                    "label"           => "Project",
//                    "backgroundColor" => "green",
//                    "data"            => [50, 80,44],
//                    "borderColor"     => "green",
//                ],
//                [
//                    "label"           => "Issue",
//                    "backgroundColor" => "red",
//                    "data"            => [70, 75,99],
//                    "borderColor"     => "red",
//                ],
//            ];
            
         
            /**
            * -------------------------------------- 
            * 1. create chart with default options
            * --------------------------------------
            */
            $barChart = (new Chart('Monthly Chart', HorizontalBarChart::class))
                ->labels(['January', 'February','March'])
                ->datasets($datasets)
                ->render();
                 
            /**
            * --------------------------------------
            * 2. create chart with modification of default options 
            * --------------------------------------
            */
//            $barChart = (new Chart('Monthly Chart', HorizontalBarChart::class))
//                ->changeDefaultOption('plugins.title.text','Monthly Project, Task And Issue Chart')
//                ->changeDefaultOption('plugins.title.color','blue')
//                ->labels(['January', 'February','March'])
//                ->datasets($datasets)
//                ->render();    
                
            /**
            * --------------------------------------
            * 3. create chart with custom options 
            * --------------------------------------
            */
//            $barChart = (new Chart('Monthly Chart', HorizontalBarChart::class))
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
//                ->labels(['January', 'February','March'])
//                ->datasets($datasets)
//                ->render();     
            
            // dd($barChart);   
               
            return view('dashboard')->with('barChart',$barChart);       
    }
}
```
**In view (dashboard.blade.php) file:**

```javascript
<script>
var serversideRenderedChartConfig = @json($barChart)

var chartCtx = document.getElementById("monthly_chart_canvas").getContext('2d');

var monthlyChart = new Chart(chartCtx,serversideRenderedChartConfig);
</script>
```