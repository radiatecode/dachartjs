var %1$s = document.getElementById("%1$s").getContext('2d');
var pluginOptions = {!! $plugins_options !!};

var config = {
    plugins : {!! $plugins_ids !!},
    type : '{{ $type }}',
    data : {
        labels : {!! $labels !!},
        datasets : {!! $datasets !!},
    },
    options: {!! $options !!}
};

if(pluginOptions){
    if(Object.keys(config.options.plugins).length === 0){
        config.options.plugins = pluginOptions;
    }else{
        config.options.plugins = Object.assign(config.options.plugins,pluginOptions);
    }
}

var %2$s = new Chart(%1$s,config);


