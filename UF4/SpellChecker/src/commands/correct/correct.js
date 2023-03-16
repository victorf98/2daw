const { ActionRowBuilder, ButtonBuilder, ButtonStyle, MessageActionRow, MessageButton } = require('discord.js');
const languageToolApi = require('../../apis/LanguageTool/languageTool');
const correccions = require('../../db/Correccions');

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
    if (errors.length == 0) {
        message.reply({ content: "No hi ha cap error, molt bé!", components: [] })
    } else {
        // for (let i = 0; i < errors.length; i++) {
            let correccio = correccions.registerCorreccio(errors);
            let id = correccio.id;
            retornarFaltes(id, missatge, message, 0, 0);
        // }
    }
}

async function retornarFaltes(id, missatge, message, index, diferencia) {
    let correccio = correccions.getCorreccio(id);
    let missatge_separat = missatge.split("");
    missatge_separat.splice(correccio.errors[index].offset + diferencia, 0, "__");
    missatge_separat.splice(correccio.errors[index].offset + correccio.errors[index].length + 1 + diferencia, 0, "__");
    let missatge_modificat = arrayToString(missatge_separat);
    let botons;
    switch (correccio.errors[index].replacements.length) {
        case 1:
            botons = new ActionRowBuilder().setComponents(
                new ButtonBuilder()
                    .setCustomId(correccio.id + "--" + correccio.errors[index].replacements[0].value + "--" + index)
                    .setLabel(correccio.errors[index].replacements[0].value)
                    .setStyle(ButtonStyle.Primary)
            )
            break;
        case 2:
            botons = new ActionRowBuilder().setComponents(
                new ButtonBuilder()
                    .setCustomId(correccio.id + "--" + correccio.errors[index].replacements[0].value + "--" + index)
                    .setLabel(correccio.errors[index].replacements[0].value)
                    .setStyle(ButtonStyle.Primary),
                new ButtonBuilder()
                    .setCustomId(correccio.id + "--" + correccio.errors[index].replacements[1].value + "--" + index)
                    .setLabel(correccio.errors[index].replacements[1].value)
                    .setStyle(ButtonStyle.Primary)
            )
            break;
        default:
            botons = new ActionRowBuilder().setComponents(
                new ButtonBuilder()
                    .setCustomId(correccio.id + "--" + correccio.errors[index].replacements[0].value + "--" + index)
                    .setLabel(correccio.errors[index].replacements[0].value)
                    .setStyle(ButtonStyle.Primary),
                new ButtonBuilder()
                    .setCustomId(correccio.id + "--" + correccio.errors[index].replacements[1].value + "--" + index)
                    .setLabel(correccio.errors[index].replacements[1].value)
                    .setStyle(ButtonStyle.Primary),
                new ButtonBuilder()
                    .setCustomId(correccio.id + "--" + correccio.errors[index].replacements[2].value + "--" + index)
                    .setLabel(correccio.errors[index].replacements[2].value)
                    .setStyle(ButtonStyle.Primary)
            )
            break;
    }

    await message.reply({
        embeds: [{
            title: "Error",
            description: correccio.errors[index].message
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
    alias,
    retornarFaltes
}