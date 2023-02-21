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

const getEstocsForMaquina = (maquinaId, filterParams) => {
  try {
    let estocs = [];
    let calaixos;
    if (filterParams.disponible == "") {
      calaixos = DB.calaixos.filter((calaix) => calaix.maquina === maquinaId);
      for (let i = 0; i < calaixos.length; i++) {
        let estoc = DB.estoc.filter((estoc) => estoc.ubicacio === calaixos[i].id && estoc.data_venda != "");
        if (estoc[0]) {
          estocs.push(estoc);
        }
      }
      if (!estocs) {
        throw {
          status: 400,
          message: `No hi ha cap maquina amb la id '${maquinaId}' disponible`,
        };
      }
    } else {
      calaixos = DB.calaixos.filter((calaix) => calaix.maquina === maquinaId);
      for (let i = 0; i < calaixos.length; i++) {
        estocs.push(DB.estoc.filter((estoc) => estoc.ubicacio === calaixos[i].id));
      }
      if (!estocs) {
        throw {
          status: 400,
          message: `No hi ha cap producte amb la id '${maquinaId}'`,
        };
      }
    }

    return estocs;
  } catch (error) {
    throw { status: error?.status || 500, message: error?.message || error };
  }
};

module.exports = {
  getAllMaquines,
  getOneMaquina,
  getEstocsForMaquina
};
