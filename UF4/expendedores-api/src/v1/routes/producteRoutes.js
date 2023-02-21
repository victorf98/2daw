const express = require("express");
const producteController = require("../../controllers/producteController");

const router = express.Router();

router
  .get("/", producteController.getAllProductes)
  .get("/:producteId", producteController.getOneProducte)
  .post("/", producteController.createNewProducte)
  .patch("/:producteId", producteController.updateOneProducte)
  .delete("/:producteId", producteController.deleteOneProducte)
  .get("/:producteId/estocs", producteController.getEstocsForProducte)

module.exports = router;
