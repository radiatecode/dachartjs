// chart js configuration

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