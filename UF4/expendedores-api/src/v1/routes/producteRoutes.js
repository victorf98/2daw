const express = require("express");
const producteController = require("../../controllers/producteController");

const router = express.Router();

router
  .get("/", producteController.getAllProductes)
  .get("/:producteId", producteController.getOneProducte)

module.exports = router;
