const DB = require("./db.json");
const { saveToDatabase } = require("./utils");

const getAllEstocs = () => {
  try {
    let estocs = DB.estoc;
    return estocs;
  } catch (error) {
    throw { status: 500, message: error };
  }
};

const getOneEstoc = (estocId) => {
  try {
    const estoc = DB.estoc.find((estoc) => estoc.id === estocId);

    if (!estoc) {
      throw {
        status: 400,
        message: `Can't find maquina with the id '${estocId}'`,
      };
    }

    return estoc;
  } catch (error) {
    throw { status: error?.status || 500, message: error?.message || error };
  }
};

const createNewEstoc = (newEstoc) => {
  try {
    const isAlreadyAdded =
      DB.estoc.findIndex((estoc) => estoc.producte === newEstoc.producte && estoc.ubicacio === newEstoc.ubicacio) > -1;

    if (isAlreadyAdded) {
      throw {
        status: 400,
        message: `Estoc with the name '${newEstoc.nom}' already exists`,
      };
    }

    DB.estoc.push(newEstoc);
    saveToDatabase(DB);

    return newEstoc;
  } catch (error) {
    throw { status: 500, message: error?.message || error };
  }
};

const updateOneEstoc = (estocId, changes) => {
  try {

    const indexForUpdate = DB.estoc.findIndex(
      (estoc) => estoc.id === estocId
    );

    if (indexForUpdate === -1) {
      throw {
        status: 400,
        message: `No es pot trobar el estoc amb la id '${estocId}'`,
      };
    }

    const updatedEstoc = {
      ...DB.estoc[indexForUpdate],
      ...changes,
      updatedAt: new Date().toLocaleString("es-ES", { timeZone: "UTC" }),
    };

    DB.estoc[indexForUpdate] = updatedEstoc;
    saveToDatabase(DB);

    return updatedEstoc;
  } catch (error) {
    throw { status: error?.status || 500, message: error?.message || error };
  }
};

const deleteOneEstoc = (estocId) => {
  try {
    const indexForDeletion = DB.estoc.findIndex(
      (estoc) => estoc.id === estocId
    );
    if (indexForDeletion === -1) {
      throw {
        status: 400,
        message: `No es pot trobar el estoc amb la id '${estocId}'`,
      };
    }
    DB.estoc.splice(indexForDeletion, 1);
    saveToDatabase(DB);
  } catch (error) {
    throw { status: error?.status || 500, message: error?.message || error };
  }
};

module.exports = {
  getAllEstocs,
  getOneEstoc,
  createNewEstoc,
  updateOneEstoc,
  deleteOneEstoc
};
