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
 * /api/v1/estocs/{maquinaId}:
 *   get:
 *     tags:
 *       - Estocs
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
 *                      $ref: "#/components/schemas/Estoc"
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
  .get("/:maquinaId/estocs", maquinaController.getEstocsForMaquina)
  .get("/:maquinaId/calaixos", maquinaController.getCalaixosForMaquina)

module.exports = router;
