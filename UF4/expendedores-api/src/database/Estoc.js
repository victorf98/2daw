const DB = require("./db.json");
const { saveToDatabase } = require("./utils");

/**
 * @openapi
 * components:
 *   schemas:
 *     Estoc:
 *       type: object
 *       properties:
 *         id: 
 *           type: string
 *           example: 2b9130d4-47a7-3546-760a-0144f6a21575
 *         producte: 
 *           type: string
 *           example: 2b9130d4-47a7-4085-800e-0144f6a21575
 *         caducitat:
 *           type: string
 *           example: 01/03/2023
 *         data_venda:
 *           type: string
 *           example: 05/03/2023
 *         ubicacio:
 *           type: string
 *           example: 12a410bc-849f-4e7e-bfc8-4ef283ee4b19
 *         createdAt:
 *           type: string
 *           example: 4/20/2022, 2:21:56 PM
 *         updatedAt: 
 *           type: string
 *           example: 4/20/2022, 2:21:56 PM
 *         
 */

const getAllEstocs = (filterParams) => {
  try {
    let estocs = DB.estoc;
    if (filterParams.venda) {
      return DB.estoc.filter((e) =>
        e.data_venda.includes(filterParams.venda)
      );
    }
    if (filterParams.disponible == "") {
      return DB.estoc.filter((e) =>
        e.data_venda != "")
    }

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
