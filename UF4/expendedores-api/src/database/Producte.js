const DB = require("./db.json");

const getAllProductes = () => {
  try {
    let productes = DB.producte;
    return productes;
  } catch (error) {
    throw { status: 500, message: error };
  }
};

const getOneProducte = (producteId) => {
  try {
    const producte = DB.producte.find((producte) => producte.id === producteId);

    if (!producte) {
      throw {
        status: 400,
        message: `Can't find maquina with the id '${producteId}'`,
      };
    }

    return producte;
  } catch (error) {
    throw { status: error?.status || 500, message: error?.message || error };
  }
};

module.exports = {
  getAllProductes,
  getOneProducte
};
