const https = require('https');

const options = {
    host: 'api.languagetoolplus.com',
    path: '/v2/check',
    method: 'POST',
    headers: {
        'Accept': 'application/json',
        'Content-Type': 'application/json; charset=UTF-8'
    }
};

const request = https.request(options, (res) => {
    // if (res.statusCode !== 201) {
    //     console.error(`Did not get a Created from the server. Code: ${res.statusCode}`);
    //     res.resume();
    //     return;
    // }

    let data = '';

    res.on('data', (chunk) => {
        data += chunk;
    });
});

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
        //.then(data => console.log(data))
        .catch(error => console.error(error));;

}


// async function getCorrection(text) {

//     const data = {
//         'text': text,
//         'language': 'auto',
//         'enabledOnly': 'false'
//     }

//     request.write(JSON.stringify(data));

//     request.end();

//     request.on('error', (err) => {
//         console.error(`Encountered an error trying to make a request: ${err.message}`);
//     });

// }

module.exports = {
    getCorrection
}
