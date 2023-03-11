const { ActionRowBuilder, ButtonBuilder, ButtonStyle } = require('discord.js');
const languageToolApi = require('../../apis/LanguageTool/languageTool');
module.exports = {
    name: 'correct',
    alias: ['corregir', 'corregeix'],

    async run(client, message, keyword) {
        let missatge_separat = message.content.split(keyword);
        if (missatge_separat[1] == "") return;
        let missatge = missatge_separat[1].trim();
        const button = new ActionRowBuilder()
            .addComponents(
                new ButtonBuilder()
                    .setCustomId('primary')
                    .setLabel(missatge)
                    .setStyle(ButtonStyle.Primary)
            );

            let response;
            let errors;
            
            await languageToolApi.getCorrection(missatge).then((res) => {
                response = res;
                errors = res.matches;
            })
            errors.forEach(error => {
                console.log(error)
                console.log("------------------------------")
            });
            
        //console.log(await languageToolApi.getCorrection(missatge));
        message.reply({ content: "__" + missatge + "__", components: [button] })

    }
}