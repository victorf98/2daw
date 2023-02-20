const producteService = require("../services/producteService");

const getAllProductes = (req, res) => {
  try {
    const allProductes = producteService.getAllProductes();
    res.send({ status: "OK", data: allProductes });
  } catch (error) {
    res
      .status(error?.status || 500)
      .send({ status: "FAILED", data: { error: error?.message || error } });
  }
};

const getOneProducte = (req, res) => {
  const {
    params: { producteId },
  } = req;

  if (!producteId) {
    res.status(400).send({
      status: "FAILED",
      data: { error: "Parameter ':producteId' can not be empty" },
    });
    return;
  }

  try {
    const producte = producteService.getOneProducte(producteId);
    res.send({ status: "OK", data: producte });
  } catch (error) {
    res
      .status(error?.status || 500)
      .send({ status: "FAILED", data: { error: error?.message || error } });
  }
};

module.exports = {
  getAllProductes,
  getOneProducte
};
