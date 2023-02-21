const DB = require("./db.json");
const { saveToDatabase } = require("./utils");

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

const createNewProducte = (newProducte) => {
  try {
    const isAlreadyAdded =
      DB.producte.findIndex((producte) => producte.nom === newProducte.nom) > -1;

    if (isAlreadyAdded) {
      throw {
        status: 400,
        message: `Producte with the name '${newProducte.nom}' already exists`,
      };
    }

    DB.producte.push(newProducte);
    saveToDatabase(DB);

    return newProducte;
  } catch (error) {
    throw { status: 500, message: error?.message || error };
  }
};

const updateOneProducte = (producteId, changes) => {
  try {

    const indexForUpdate = DB.producte.findIndex(
      (producte) => producte.id === producteId
    );

    if (indexForUpdate === -1) {
      throw {
        status: 400,
        message: `No es pot trobar el producte amb la id '${producteId}'`,
      };
    }

    const updatedProducte = {
      ...DB.producte[indexForUpdate],
      ...changes,
      updatedAt: new Date().toLocaleString("es-ES", { timeZone: "UTC" }),
    };

    DB.producte[indexForUpdate] = updatedProducte;
    saveToDatabase(DB);

    return updatedProducte;
  } catch (error) {
    throw { status: error?.status || 500, message: error?.message || error };
  }
};

const deleteOneProducte = (producteId) => {
  try {
    const indexForDeletion = DB.producte.findIndex(
      (producte) => producte.id === producteId
    );
    if (indexForDeletion === -1) {
      throw {
        status: 400,
        message: `No es pot trobar el producte amb la id '${producteId}'`,
      };
    }
    DB.producte.splice(indexForDeletion, 1);
    saveToDatabase(DB);
  } catch (error) {
    throw { status: error?.status || 500, message: error?.message || error };
  }
};

const getEstocsForProducte = (producteId, filterParams) => {
  try {
    let estocs;
    if (filterParams.disponible == "") {
      estocs = DB.estoc.filter((estoc) => estoc.producte === producteId && estoc.data_venda != "");
      if (!estocs) {
        throw {
          status: 400,
          message: `No hi ha cap producte amb la id '${producteId}' disponible`,
        };
      }
    }else{
      estocs = DB.estoc.find((estoc) => estoc.producte === producteId);
      if (!estocs) {
        throw {
          status: 400,
          message: `No hi ha cap producte amb la id '${producteId}'`,
        };
      }
    }

    return estocs;
  } catch (error) {
    throw { status: error?.status || 500, message: error?.message || error };
  }
};

module.exports = {
  getAllProductes,
  getOneProducte,
  createNewProducte,
  updateOneProducte,
  deleteOneProducte,
  getEstocsForProducte
};
