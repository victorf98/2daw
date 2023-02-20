const DB = require("./db.json");

const getAllMaquines = () => {
  try {
    let maquines = DB.maquina;
    return maquines;
  } catch (error) {
    throw { status: 500, message: error };
  }
};

const getOneMaquina = (maquinaId) => {
  try {
    const maquina = DB.maquina.find((maquina) => maquina.id === maquinaId);

    if (!maquina) {
      throw {
        status: 400,
        message: `Can't find maquina with the id '${maquinaId}'`,
      };
    }

    return maquina;
  } catch (error) {
    throw { status: error?.status || 500, message: error?.message || error };
  }
};

module.exports = {
  getAllMaquines,
  getOneMaquina
};
