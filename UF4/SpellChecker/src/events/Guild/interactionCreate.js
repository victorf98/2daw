const corregirFrase = require('../../Functions/corregirFrase');


module.exports = async (client, interaction) => {
    if (!interaction.guild || !interaction.channel) return;
    if (interaction.isButton()) {
        corregirFrase.execute(interaction);
    } else {
        const command = client.slashCommands.get(interaction?.commandName);

        if (command) {
            const cmd = require("../../slashCommands/" + interaction.commandName + "/" + command);

            try {
                cmd.execute(client, interaction, "/")
            } catch (error) {
                console.log(error);
            }
        }
    }
}