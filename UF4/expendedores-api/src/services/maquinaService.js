const { v4: uuid } = require("uuid");
const Maquina = require("../database/Maquina");

const getAllMaquines = () => {
  try {
    const allMaquines = Maquina.getAllMaquines();
    return allMaquines;
  } catch (error) {
    throw error;
  }
};

const getOneMaquina = (maquinaId) => {
  try {
    const maquina = Maquina.getOneMaquina(maquinaId);
    return maquina;
  } catch (error) {
    throw error;
  }
};

const getEstocsForMaquina = (maquinaId, filterParams) => {
  try {
    const estocs = Maquina.getEstocsForMaquina(maquinaId, filterParams);
    return estocs;
  } catch (error) {
    throw error;
  }
};

const getCalaixosForMaquina = (maquinaId, filterParams) => {
  try {
    const estocs = Maquina.getCalaixosForMaquina(maquinaId, filterParams);
    return estocs;
  } catch (error) {
    throw error;
  }
};

module.exports = {
  getAllMaquines,
  getOneMaquina,
  getEstocsForMaquina,
  getCalaixosForMaquina
};
