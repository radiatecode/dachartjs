var %1$s = document.getElementById("%1$s").getContext('2d');
var %2$s = new Chart(%1$s,@json($chartConfig));

var httpRequest;

var datasetsLength = {{ $datasetsLength }};

document.getElementById("%3$s").addEventListener('click', makeRequest);

function makeRequest() {
    var data = '%5$s';
    var url = data ? '%4$s?'+data : '%4$s';

    httpRequest = new XMLHttpRequest();

    if (!httpRequest) {
        alert('Giving up :( Cannot create an AJAX instance');
        return false;
    }

    httpRequest.onreadystatechange = responseContents;
    httpRequest.open('GET', url);
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

function chartRefresh(data){
    // set response data to chart datasets
    for(var i = 0; i < datasetsLength; i++){
        %2$s.data.datasets[i].data = data[i];
    }

    // update or refresh chart
    %2$s.update();
}