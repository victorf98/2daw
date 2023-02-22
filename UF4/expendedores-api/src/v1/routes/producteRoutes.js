const express = require("express");
const producteController = require("../../controllers/producteController");

const router = express.Router();

router

/**
 * @openapi
 * /api/v1/productes:
 *   get:
 *     tags:
 *       - Productes
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
 *                      $ref: "#/components/schemas/Producte"
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
  .get("/", producteController.getAllProductes)

/**
 * @openapi
 * /api/v1/productes/{producteId}:
 *   get:
 *     tags:
 *       - Productes
 *     parameters:
 *       - in: path
 *         name: producteId
 *         schema:
 *           type: string
 *         description: Id d'un producte
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
 *                      $ref: "#/components/schemas/Producte"
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
  .get("/:producteId", producteController.getOneProducte)

/**
 * @openapi
 * /api/v1/productes:
 *   post:
 *     tags:
 *       - Productes
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
 *                      $ref: "#/components/schemas/Producte"
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
  .post("/", producteController.createNewProducte)

  /**
 * @openapi
 * /api/v1/productes/{producteId}:
 *   patch:
 *     tags:
 *       - Productes
 *     parameters:
 *       - in: path
 *         name: producteId
 *         schema:
 *           type: string
 *         description: Id d'un producte
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
 *                      $ref: "#/components/schemas/Producte"
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
  .patch("/:producteId", producteController.updateOneProducte)

  /**
 * @openapi
 * /api/v1/productes/{producteId}:
 *   delete:
 *     tags:
 *       - Productes
 *     parameters:
 *       - in: path
 *         name: producteId
 *         schema:
 *           type: string
 *         description: Id d'un producte
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
 *                      $ref: "#/components/schemas/Producte"
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
  .delete("/:producteId", producteController.deleteOneProducte)

/**
 * @openapi
 * /api/v1/productes/{producteId}/estocs:
 *   get:
 *     tags:
 *       - Productes
 *     parameters:
 *       - in: path
 *         name: producteId
 *         schema:
 *           type: string
 *         description: Id d'un producte
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
 *                      $ref: "#/components/schemas/Producte"
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
  .get("/:producteId/estocs", producteController.getEstocsForProducte)

module.exports = router;
