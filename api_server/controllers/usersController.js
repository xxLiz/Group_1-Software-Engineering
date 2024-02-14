const { usersModel, getAll_pg, getById_pg, update_pg, insert_pg, delete_pg } = require('../models/usersModel');



const getAllUsers = async (req, res) => {
    res.json(await getAll_pg());
    console.log('sent json');
}

const getUserById = async (req, res) => {
    res.json(await getById_pg(parseInt(req.params.id)));
}

const updateUser = async (req, res) => {
    res.json(await update_pg(req.body.id, req.body.fname, req.body.lname, req.body.email) == 0 ? { success: false } : { success: true });
}

const createUser = async (req, res) => {
    res.json(await insert_pg(req.body.fname, req.body.lname, req.body.email) == 0 ? { success: false } : { success: true })
}

const deleteUser = async (req, res) => {
    res.json(await delete_pg(req.body.id) == 0 ? { success: false } : { success: true })
}

module.exports = { getAllUsers, getUserById, updateUser, createUser, deleteUser };