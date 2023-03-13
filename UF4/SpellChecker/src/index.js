const { Client, GatewayIntentBits, Partials, ActionRowBuilder, ButtonBuilder, ButtonStyle, Events, Collection } = require('discord.js');
const { Guilds, GuildMembers, GuildMessages, MessageContent } = GatewayIntentBits;
const { User, Message, GuildMember, ThreadMember } = Partials;
const corregirFrase = require('./events/corregirFrase');

const client = new Client({
    intents: [Guilds, GuildMembers, GuildMessages, MessageContent],
    partials: [User, Message, GuildMember, ThreadMember],
});
const fs = require("fs");

const config = require("../config.json");

client.on("ready", () => {
    console.log("El cliente ya esta listo");
});

client.login(config.token);

client.on("messageCreate", async (message) => {
    if (message.author.bot || !message.guild || message.channel.type === "DM") return;

    let keyword = hiHaKeywords(message.content.split(" "), keywords);

    if (!keyword) return;

    let cmd = client.commands.find((c) => c.name === keyword || (c.alias && c.alias.includes(keyword)));
    cmd.run(client, message, keyword);


});

client.commands = new Collection();

client.on("interactionCreate", async (interaction) => {
    if (!interaction.isButton()) return;
    corregirFrase.execute(interaction);
});

fs.readdirSync(__dirname + "/commands").forEach((dir) => {
    const commands = fs.readdirSync(`${__dirname}/commands/${dir}/`).filter((file) => file.endsWith(".js"));
    for (let file of commands) {
        let command = require(`./commands/${dir}/${file}`);
        console.log(`Comando ${command.name} cargado`);
        client.commands.set(command.name, command);
    }
})

let keywords = [];

client.commands.forEach((command) => {
    keywords.push(command.name);
    command.alias.forEach((alias) => {
        keywords.push(alias);
    });
});

function hiHaKeywords(missatge, keywords) {
    for (let i = 0; i < missatge.length; i++) {
        for (let j = 0; j < keywords.length; j++) {
            if (missatge[i] === keywords[j]) {
                return keywords[j];
            }
        }
    }
    return false;
}