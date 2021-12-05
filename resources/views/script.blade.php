var %1$s = document.getElementById("%1$s").getContext('2d');
var config = '{!! json_encode($chartConfig) !!}';
var %2$s = new Chart(%1$s,JSON.parse(config));