function getJSON(url, callback) {
    var request = new XMLHttpRequest()
    request.onreadystatechange = function () {
        if (request.readyState === 4 && request.status === 200) {
            callback(JSON.parse(request.responseText));
        }
    }
    request.open('GET', url)
    request.send()
}

function dataSet(element) {
    var dataset = {},
        match;
    [].forEach.call(element.attributes, function (attribute) {
        match = attribute.name.match(/data-([a-z]+)/i);
        if (match) {
            dataset[match[1]] = attribute.value;
        }
    });
    return dataset;
}

function domExtract(string, nodename) {
    var container = document.createElement('div');
    container.innerHTML = string;
    return container.querySelector(nodename);
}