//--- chart js configuration
var %1$s = document.getElementById("%1$s").getContext('2d');

var %1$s_config = {
    type : '{{ $type }}',
    data : {
        labels : {!! $labels !!},
        datasets : {!! $datasets !!},
    },
    options: {!! $options !!}
};

var %2$s = new Chart(%1$s,%1$s_config);
//--- end chart js configuration

/**
* Data load by ajax
* Params: chart,ajaxOptions,clickEventId,inputElementIds
*/
dataLoad(%2$s,JSON.parse('%4$s'),'%3$s',JSON.parse('%5$s'));