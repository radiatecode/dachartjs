// chart js configuration

var %1$s = document.getElementById("%1$s").getContext('2d');

var config = {
    type : '{{ $type }}',
    data : {
        labels : {!! $labels !!},
        datasets : {!! $datasets !!},
    },
    options: {!! $options !!}
};

var %2$s = new Chart(%1$s,config);

function chartRefresh(data){
    if(data.datasets !== undefined){
        %2$s.data.datasets = data.datasets;
    }

    if(data.labels !== undefined){
        %2$s.data.labels = data.labels;
    }

    // update or refresh chart
    %2$s.update();
}