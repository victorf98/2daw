const https = require('https');

function getCorrection(text) {

    return fetch('https://api.languagetoolplus.com/v2/check', {
        method: 'POST',
        headers: {
            'Accept': 'application/json'
        },
        body: new URLSearchParams({
            'text': text,
            'language': 'auto',
            'enabledOnly': 'false'
        })
    })
        .then(response => response.json())
        .catch(error => console.error(error));;

}

module.exports = {
    getCorrection
}
