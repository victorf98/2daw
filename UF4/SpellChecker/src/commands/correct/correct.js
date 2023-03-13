const { ActionRowBuilder, ButtonBuilder, ButtonStyle, MessageActionRow, MessageButton } = require('discord.js');
const languageToolApi = require('../../apis/LanguageTool/languageTool');

const name = 'correct';
const alias = ['corregir', 'corregeix'];

async function run(client, message, keyword) {
    let missatge_separat = message.content.split(keyword);
    if (missatge_separat[1] == "") return;
    let missatge = missatge_separat[1].trim();

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
    if (errors.length == 0) {
        message.reply({ content: "No hi ha cap error, molt bé!", components: [] })
    } else {
        for (let i = 0; i < errors.length; i++) {
            retornarFaltes(errors[i], missatge, message);
        }
    }
}

async function retornarFaltes(faltes, missatge, message) {
    let missatge_separat = missatge.split("");
    missatge_separat.splice(faltes.offset, 0, "__");
    missatge_separat.splice(faltes.offset + faltes.length + 1, 0, "__");
    let missatge_modificat = arrayToString(missatge_separat);
    let botons;
    switch (faltes.replacements.length) {
        case 1:
            botons = new ActionRowBuilder().setComponents(
                new ButtonBuilder()
                    .setCustomId('correccio')
                    .setLabel(faltes.replacements[0].value)
                    .setStyle(ButtonStyle.Primary)
            )
            break;
        case 2:
            botons = new ActionRowBuilder().setComponents(
                new ButtonBuilder()
                    .setCustomId('correccio-1')
                    .setLabel(faltes.replacements[0].value)
                    .setStyle(ButtonStyle.Primary),
                new ButtonBuilder()
                    .setCustomId('correccio-2')
                    .setLabel(faltes.replacements[1].value)
                    .setStyle(ButtonStyle.Secondary)
            )
            break;
        default:
            botons = new ActionRowBuilder().setComponents(
                new ButtonBuilder()
                    .setCustomId('correccio-1')
                    .setLabel(faltes.replacements[0].value)
                    .setStyle(ButtonStyle.Primary),
                new ButtonBuilder()
                    .setCustomId('correccio-2')
                    .setLabel(faltes.replacements[1].value)
                    .setStyle(ButtonStyle.Primary),
                new ButtonBuilder()
                    .setCustomId('correccio-3')
                    .setLabel(faltes.replacements[2].value)
                    .setStyle(ButtonStyle.Primary)
            )
            break;
    }

    await message.reply({
        embeds: [{
            title: "Error",
            description: faltes.message
        }],
        content: missatge_modificat, components: [botons]
    })
}

function arrayToString(array) {
    let string = "";
    for (let i = 0; i < array.length; i++) {
        string += array[i];
    }
    return string;
}

module.exports = {
    run,
    name,
    alias
}