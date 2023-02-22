const express = require("express");
const maquinaController = require("../../controllers/maquinaController");

const router = express.Router();

router

/**
 * @openapi
 * /api/v1/maquines:
 *   get:
 *     tags:
 *       - Maquines
 *     responses:
 *       200:
 *         description: OK
 *         content:
 *           application/json:
 *             schema:
 *               type: object
 *               properties:
 *                 status:
 *                   type: string
 *                   example: OK
 *                 data:
 *                   type: array 
 *                   items: 
 *                      $ref: "#/components/schemas/Maquina"
 *       5XX:
 *         description: FAILED
 *         content:
 *           application/json:
 *             schema:
 *               type: object
 *               properties:
 *                 status: 
 *                   type: string
 *                   example: FAILED
 *                 data:
 *                   type: object
 *                   properties:
 *                     error:
 *                       type: string 
 *                       example: "Some error message"
 */
  .get("/", maquinaController.getAllMaquines)

  /**
 * @openapi
 * /api/v1/maquines/{maquinaId}:
 *   get:
 *     tags:
 *       - Maquines
 *     parameters:
 *       - in: path
 *         name: maquinaId
 *         schema:
 *           type: string
 *         description: Id d'una maquina
 *     responses:
 *       200:
 *         description: OK
 *         content:
 *           application/json:
 *             schema:
 *               type: object
 *               properties:
 *                 status:
 *                   type: string
 *                   example: OK
 *                 data:
 *                   type: array 
 *                   items: 
 *                      $ref: "#/components/schemas/Maquina"
 *       5XX:
 *         description: FAILED
 *         content:
 *           application/json:
 *             schema:
 *               type: object
 *               properties:
 *                 status: 
 *                   type: string
 *                   example: FAILED
 *                 data:
 *                   type: object
 *                   properties:
 *                     error:
 *                       type: string 
 *                       example: "Some error message"
 */
  .get("/:maquinaId", maquinaController.getOneMaquina)

/**
 * @openapi
 * /api/v1/maquines/{maquinaId}/estocs:
 *   get:
 *     tags:
 *       - Maquines
 *     parameters:
 *       - in: path
 *         name: maquinaId
 *         schema:
 *           type: string
 *         description: Id d'una maquina
 *       - in: query
 *         name: disponible
 *         schema:
 *           type: string
 *         description: Si està a la ruta es retorna els estocs que no s'han venut
 *     responses:
 *       200:
 *         description: OK
 *         content:
 *           application/json:
 *             schema:
 *               type: object
 *               properties:
 *                 status:
 *                   type: string
 *                   example: OK
 *                 data:
 *                   type: array 
 *                   items: 
 *                      $ref: "#/components/schemas/Maquina"
 *       400:
 *         description: FAILED
 *         content:
 *           application/json:
 *             schema:
 *               type: object
 *               properties:
 *                 status: 
 *                   type: string
 *                   example: FAILED
 *                 data:
 *                   type: object
 *                   properties:
 *                     error:
 *                       type: string 
 *                       example: "Some error message"
 *       5XX:
 *         description: FAILED
 *         content:
 *           application/json:
 *             schema:
 *               type: object
 *               properties:
 *                 status: 
 *                   type: string
 *                   example: FAILED
 *                 data:
 *                   type: object
 *                   properties:
 *                     error:
 *                       type: string 
 *                       example: "Some error message"
 */
  .get("/:maquinaId/estocs", maquinaController.getEstocsForMaquina)

   /**
 * @openapi
 * /api/v1/maquines/{maquinaId}/calaixos:
 *   get:
 *     tags:
 *       - Maquines
 *     parameters:
 *       - in: path
 *         name: maquinaId
 *         schema:
 *           type: string
 *         description: Id d'una maquina
 *       - in: query
 *         name: buits
 *         schema:
 *           type: string
 *         description: Si està a la ruta es retorna els calaixos que estan buits
 *     responses:
 *       200:
 *         description: OK
 *         content:
 *           application/json:
 *             schema:
 *               type: object
 *               properties:
 *                 status:
 *                   type: string
 *                   example: OK
 *                 data:
 *                   type: array 
 *                   items: 
 *                      $ref: "#/components/schemas/Maquina"
 *       400:
 *         description: FAILED
 *         content:
 *           application/json:
 *             schema:
 *               type: object
 *               properties:
 *                 status: 
 *                   type: string
 *                   example: FAILED
 *                 data:
 *                   type: object
 *                   properties:
 *                     error:
 *                       type: string 
 *                       example: "Some error message"
 *       5XX:
 *         description: FAILED
 *         content:
 *           application/json:
 *             schema:
 *               type: object
 *               properties:
 *                 status: 
 *                   type: string
 *                   example: FAILED
 *                 data:
 *                   type: object
 *                   properties:
 *                     error:
 *                       type: string 
 *                       example: "Some error message"
 */
  .get("/:maquinaId/calaixos", maquinaController.getCalaixosForMaquina)

module.exports = router;
