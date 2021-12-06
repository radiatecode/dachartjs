var %1$s = document.getElementById("%1$s").getContext('2d');
var %2$s = new Chart(%1$s,{
    type : '{{ $type }}',
    data : {
        labels : {!! $labels !!},
        datasets : {!! $datasets !!},
    },
    options: {!! $options !!}
});