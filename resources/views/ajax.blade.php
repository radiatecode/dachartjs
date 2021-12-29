/*!
* Ajax Chart
*/
function dataLoad(chart, ajaxOptions, eventId = null, elements = null) {
    // default load
    makeRequest(chart, ajaxOptions, elements);

    if (eventId) {
        var eventElm = document.getElementById(eventId);

        if (eventId === null || eventId === undefined) {
            alert(eventId + ' id is not found!');
            return false;
        }

        // data load by firing event
        eventElm.addEventListener('click', function () {
            makeRequest(chart, ajaxOptions, elements)
        });
    }

    return true;
}

function makeRequest(chart, ajaxOptions, elements = null) {
    // ajax options
    var url = ajaxOptions.url;
    var type = ajaxOptions.type === undefined ? 'GET' : ajaxOptions.type;
    var headers = ajaxOptions.headers === undefined ? {} : ajaxOptions.headers;
    var params = generateUrlParams(elements);

    var httpRequest = new XMLHttpRequest();

    if (!httpRequest) {
        alert('Giving up :( Cannot create an AJAX instance');

        return false;
    }

    // if type is get then attach query string with the given url
    if (type.toLowerCase() === 'get') {
        var queryStringExist = detectQueryString(url);
        url = queryStringExist ? url + '&' + params : url + '?' + params;
    }

    httpRequest.onreadystatechange = function () {
        if (httpRequest.readyState === XMLHttpRequest.DONE) {
            if (httpRequest.status === 200) {
                var data = JSON.parse(httpRequest.responseText);

                chartRefresh(chart, data);
            } else {
                alert('There was a problem with the request.');
                console.log(httpRequest);
            }
        }
    };

    httpRequest.open(type, url);

    // headers add
    if (headers.length !== 0) {
        for (var i in headers) {
            httpRequest.setRequestHeader(i, headers[i]);
        }
    }

    // if http request type is post then add form header and send data
    if (type.toLowerCase() === 'post') {
        httpRequest.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        params = generateUrlParams(elements);
        httpRequest.send(params);

        return true;
    }

    httpRequest.send();

    return true;
}

function chartRefresh(chart, data) {
    if (data.datasets !== undefined) {
        chart.data.datasets = data.datasets;
    }

    if (data.labels !== undefined) {
        chart.data.labels = data.labels;
    }

    // update or refresh chart
    chart.update();
}

function generateUrlParams(elements) {
    var params = [];

    for (var i in elements) {
        var elmVal = document.getElementById(elements[i]);

        if (elmVal === null || elmVal === undefined) {
            console.error(elements[i] + ' id is not found!');
        } else {
            params.push(elements[i] + "=" + elmVal.value);
        }
    }

    return params.join('&');
}

function detectQueryString(url) {
    // regex pattern for detecting querystring
    var pattern = new RegExp(/\?.+=.*/g);
    return pattern.test(url);
}
//---------------------------- end ajax chart