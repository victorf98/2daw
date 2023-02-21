const express = require("express");
const maquinaController = require("../../controllers/maquinaController");

const router = express.Router();

router
  .get("/", maquinaController.getAllMaquines)
  .get("/:maquinaId", maquinaController.getOneMaquina)
  .get("/:maquinaId/estocs", maquinaController.getEstocsForMaquina)
  .get("/:maquinaId/calaixos", maquinaController.getCalaixosForMaquina)

module.exports = router;
