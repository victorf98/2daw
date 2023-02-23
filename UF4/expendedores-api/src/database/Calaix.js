const DB = require("./db.json");

/**
 * @openapi
 * components:
 *   schemas:
 *     Calaix:
 *       type: object
 *       properties:
 *         id: 
 *           type: string
 *           example: 12a410bc-849f-4e7e-bfc8-4ef283ee4b19
 *         maquina: 
 *           type: string
 *           example: 61dbae02-c147-4e28-863c-db7bd402b2d6
 *         casella:
 *           type: string
 *           example: 1
 *         createdAt:
 *           type: string
 *           example: 4/20/2022, 2:21:56 PM
 *         updatedAt: 
 *           type: string
 *           example: 4/20/2022, 2:21:56 PM
 *         
 */


const getCalaixosForMaquina = (maquinaId, filterParams) => {
  try {
    let calaixos = [];
    if (filterParams.buits == "") {
      let tots_calaixos = DB.calaixos.filter((calaix) => calaix.maquina === maquinaId);
      tots_calaixos.forEach(calaix => {
        let estoc = DB.estoc.filter((estoc) => estoc.ubicacio === calaix.id);
        if (!estoc[0]) {
          calaixos.push(calaix);
        }
      });
      if (!calaixos) {
        throw {
          status: 400,
          message: `No hi ha cap maquina amb la id '${maquinaId}' disponible`,
        };
      }
    } else {
      calaixos = DB.calaixos.filter((calaix) => calaix.maquina === maquinaId);
      if (!calaixos) {
        throw {
          status: 400,
          message: `No hi ha cap maquina amb la id '${maquinaId}'`,
        };
      }
    }

    return calaixos;
  } catch (error) {
    throw { status: error?.status || 500, message: error?.message || error };
  }
};

module.exports = {
  getCalaixosForMaquina
};
