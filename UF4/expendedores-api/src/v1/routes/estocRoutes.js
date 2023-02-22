const express = require("express");
const estocController = require("../../controllers/estocController");

const router = express.Router();

router
/**
 * @openapi
 * /api/v1/estocs:
 *   get:
 *     tags:
 *       - Estocs
 *     parameters:
 *       - in: query
 *         name: venda
 *         schema:
 *           type: string
 *         description: Data per la qual cercar estocs per la data de venda
 *       - in: query
 *         name: disponible
 *         schema:
 *           type: string
 *         description: Si està a la ruta es retorna els estocs disponibles
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
  .get("/", estocController.getAllEstocs)

/**
 * @openapi
 * /api/v1/estocs/{estocId}:
 *   get:
 *     tags:
 *       - Estocs
 *     parameters:
 *       - in: path
 *         name: estocId
 *         schema:
 *           type: string
 *         description: Id d'un estoc
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
  .get("/:estocId", estocController.getOneEstoc)

/**
 * @openapi
 * /api/v1/estocs:
 *   post:
 *     tags:
 *       - Estocs
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
  .post("/", estocController.createNewEstoc)

  /**
 * @openapi
 * /api/v1/estocs/{estocId}:
 *   patch:
 *     tags:
 *       - Estocs
 *     parameters:
 *       - in: path
 *         name: estocId
 *         schema:
 *           type: string
 *         description: Id d'un estoc
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
  .patch("/:estocId", estocController.updateOneEstoc)

  /**
 * @openapi
 * /api/v1/estocs/{estocId}:
 *   delete:
 *     tags:
 *       - Estocs
 *     parameters:
 *       - in: path
 *         name: estocId
 *         schema:
 *           type: string
 *         description: Id d'un estoc
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
  .delete("/:estocId", estocController.deleteOneEstoc)

module.exports = router;
