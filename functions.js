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

function domExtract(string, nodename) {
    var container = document.createElement('div');
    container.innerHTML = string;
    return container.querySelector(nodename);
}
