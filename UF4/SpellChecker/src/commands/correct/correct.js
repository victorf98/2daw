const { ActionRowBuilder, ButtonBuilder, ButtonStyle } = require('discord.js');
module.exports = {
    name: 'correct',
    alias: ['corregir', 'corregeix'],

    run(client, message, keyword) {
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
        message.reply({ content: "__" + missatge + "__", components: [button] })

    }
}