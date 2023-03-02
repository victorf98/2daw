const { Client, GatewayIntentBits, Partials, ActionRowBuilder, ButtonBuilder } = require('discord.js');
const { Guilds, GuildMembers, GuildMessages, MessageContent } = GatewayIntentBits;
const { User, Message, GuildMember, ThreadMember } = Partials;

const client = new Client({
    intents: [Guilds, GuildMembers, GuildMessages, MessageContent],
    partials: [User, Message, GuildMember, ThreadMember],
});

const config = require("../config.json");
const token = require("../../../../token.json");

client.on("ready", () => {
    console.log("El cliente ya esta listo");
});

client.login(token.token);

client.on("messageCreate", async (message) => {
    if (message.author.bot || !message.guild || message.channel.type === "DM") return;
    let trigger = config.trigger;

    if (!message.content.split(" ").includes(trigger)) {
        return;
    } else {
        // const embed = new EmbedBuilder()
        //     .setTitle("Correccion")
        //     .setDescription("Corrected 📋");
        
            const button = new ActionRowBuilder()
			.addComponents(
				new ButtonBuilder()
					.setCustomId('primary')
					.setLabel('Click me!')
			);


        await message.send({ content: "Corrected 📋" , components: [button]});
    }

});