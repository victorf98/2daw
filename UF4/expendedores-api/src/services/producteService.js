const { v4: uuid } = require("uuid");
const Producte = require("../database/Producte");

const getAllProductes = () => {
  try {
    const allProductes = Producte.getAllProductes();
    return allProductes;
  } catch (error) {
    throw error;
  }
};

const getOneProducte = (producteId) => {
  try {
    const producte = Producte.getOneProducte(producteId);
    return producte;
  } catch (error) {
    throw error;
  }
};

const createNewWorkout = (newWorkout) => {
  const workoutToInsert = {
    ...newWorkout,
    id: uuid(),
    createdAt: new Date().toLocaleString("en-US", { timeZone: "UTC" }),
    updatedAt: new Date().toLocaleString("en-US", { timeZone: "UTC" }),
  };
  try {
    const createdWorkout = Workout.createNewWorkout(workoutToInsert);
    return createdWorkout;
  } catch (error) {
    throw error;
  }
};

const updateOneWorkout = (workoutId, changes) => {
  try {
    const updatedWorkout = Workout.updateOneWorkout(workoutId, changes);
    return updatedWorkout;
  } catch (error) {
    throw error;
  }
};

const deleteOneWorkout = (workoutId) => {
  try {
    Workout.deleteOneWorkout(workoutId);
  } catch (error) {
    throw error;
  }
};

module.exports = {
  getAllProductes,
  getOneProducte,
  createNewWorkout,
  updateOneWorkout,
  deleteOneWorkout,
};
