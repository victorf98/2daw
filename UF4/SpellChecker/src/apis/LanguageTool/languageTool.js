const https = require('https');

async function getCorrection(text) {
        
    return await fetch('https://api.languagetoolplus.com/v2/check', {
        method: 'POST',
        headers: {
            'Accept': 'application/json'
        },
        body: JSON.stringify({
            'text': text,
            'language': 'auto',
            'enabledOnly': 'false'
        })
    }).then(response => response.json())
    .then(json => console.log(json));
}


// getQuadres(documents_per_pagina: number, pagina: number): Observable < any > {
//     return this.http.get("https://api.artic.edu/api/v1/artworks?page=" + pagina + "&limit=" + documents_per_pagina, this.requestOptions);
// }

// getArtista(id: number): Observable < any > {
//     return this.http.get("https://api.artic.edu/api/v1/artists/" + id, this.requestOptions);
// }

module.exports = {
    getCorrection
}
