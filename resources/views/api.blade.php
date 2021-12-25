//--- chart js configuration
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
//--- end chart js configuration

//--- chart data load and update based on some inputs via ajax
var httpRequest;

var clickEventId = '%3$s';

// ajax options
var ajaxOptions = JSON.parse('%4$s');
var url = ajaxOptions.url;
var type = ajaxOptions.type === undefined ? 'GET' : ajaxOptions.type;
var headers = ajaxOptions.headers === undefined ? {} : ajaxOptions.headers;

// ids of form element
var elements = JSON.parse('%5$s');

// load data
dataLoad();

// check whether chart data update by click event
if(clickEventId){
    var eventId = document.getElementById(clickEventId)
    if(eventId === null || eventId === undefined){
        alert(clickEventId+' id is not found!');
    }else{
        eventId.addEventListener('click', dataLoad);
    }
}

function dataLoad(){
    if(type.toLowerCase() == 'post'){
        return makeRequest(url);
    }

    // if type is get then attach query string with the given url
    var queryStringExist = detectQueryString(url);
    var params = generateUrlParams();
    var urlQueryString = queryStringExist ? url+'&'+params : url+'?'+params;

    return makeRequest(urlQueryString);
}

function makeRequest(path) {
    httpRequest = new XMLHttpRequest();

    if (!httpRequest) {
        alert('Giving up :( Cannot create an AJAX instance');
        return false;
    }

    httpRequest.onreadystatechange = responseContents;
    httpRequest.open(type, path);

    // headers add
    if(headers.length != 0){
        for(var i in headers){
            httpRequest.setRequestHeader(i, headers[i]);
        }
    }

    // if http request type is post then add form header and send data
    if(type.toLowerCase() == 'post'){
        httpRequest.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        var params = generateUrlParams();
        console.log('pp',params);
        httpRequest.send(params);

        return true;
    }

    httpRequest.send();

    return true;
}

function responseContents() {
    if (httpRequest.readyState === XMLHttpRequest.DONE) {
        if (httpRequest.status === 200) {
            var data = JSON.parse(httpRequest.responseText);

            chartRefresh(data);
        } else {
            alert('There was a problem with the request.');
            console.log(httpRequest);
        }
    }
}

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

function generateUrlParams(){
    var params = [];

    for(var i in elements){
        var elmVal = document.getElementById(elements[i]);

        if(elmVal === null || elmVal === undefined){
            console.error(elements[i]+' id is not found!');
        }else{
            params.push(elements[i]+"="+elmVal.value);
        }
    }

    return params.join('&');
}

function detectQueryString(url) {
    // regex pattern for detecting querystring
    var pattern = new RegExp(/\?.+=.*/g);
    return pattern.test(url);
}
//--- end chart data load and update based on some inputs via ajax