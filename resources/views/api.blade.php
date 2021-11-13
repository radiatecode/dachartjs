var %1$s = document.getElementById("%1$s").getContext('2d');
var %2$s = new Chart(%1$s,@json($chartConfig));

var httpRequest;

var datasetsLength = {{ $datasetsLength }};

// string of ids of form element
var elements = '%5$s';

var loadTriggerId = '%3$s';

var url = "%4$s";

// get data
makeRequest(url);

// check whether chart data update by click event
if(loadTriggerId){
    document.getElementById(loadTriggerId).addEventListener('click', dataLoad);
}

function dataLoad(){
    if(elements){
        var queryStringExist = detectQueryString(url);
        var params = generateUrlParams();
        var urlQueryString = queryStringExist ? url+'&'+params : url+'?'+params;

        // get data
        makeRequest(urlQueryString);
    }
}

function makeRequest(path) {
    httpRequest = new XMLHttpRequest();

    if (!httpRequest) {
        alert('Giving up :( Cannot create an AJAX instance');
        return false;
    }

    httpRequest.onreadystatechange = responseContents;
    httpRequest.open('GET', path);
    httpRequest.send();
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

function generateUrlParams(){
    var elms = elements.split("#");
    var params = [];
    for(var i in elms){
        var elmVal = document.getElementById(elms[i]).value;
        params.push(elms[i]+"="+elmVal);
    }

    return params.join('&');
}

function chartRefresh(data){
    // set response data to chart datasets
    for(var i = 0; i < datasetsLength; i++){
        %2$s.data.datasets[i].data = data[i];
    }

    // update or refresh chart
    %2$s.update();
}

function detectQueryString(url) {
    // regex pattern for detecting querystring
    var pattern = new RegExp(/\?.+=.*/g);
    return pattern.test(url);
}