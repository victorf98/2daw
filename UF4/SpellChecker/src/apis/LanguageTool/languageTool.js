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

const requestData = {
    name: 'New User',
    username: 'digitalocean',
    email: 'user@digitalocean.com',
    address: {
        street: 'North Pole',
        city: 'Murmansk',
        zipcode: '12345-6789',
    },
    phone: '555-1212',
    website: 'digitalocean.com',
    company: {
        name: 'DigitalOcean',
        catchPhrase: 'Welcome to the developer cloud',
        bs: 'cloud scale security'
    }
};

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
