const Calaix = require("../database/Calaix");

const getCalaixosForMaquina = (maquinaId, filterParams) => {
  try {
    const estocs = Calaix.getCalaixosForMaquina(maquinaId, filterParams);
    return estocs;
  } catch (error) {
    throw error;
  }
};

module.exports = {
  getCalaixosForMaquina
};
