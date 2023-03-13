const { ButtonInteraciton } = require('discord.js');

const name = 'corregirFrase';

function execute(interaction) {
    const button = interaction.customId;
    const faltes = interaction.message.embeds[0].fields[0].value;
    const missatge = interaction.message.embeds[0].fields[1].value;
    const missatge_separat = missatge.split("__");
    const missatge_modificat = missatge_separat[0] + button + missatge_separat[1];
    interaction.message.edit({ content: missatge_modificat, components: [] });
}

module.exports = {
    name,
    execute,
};