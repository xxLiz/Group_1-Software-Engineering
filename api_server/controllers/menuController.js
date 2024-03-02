const { getAll_pg, getById_pg, update_pg, insert_pg, delete_pg } = require('../models/menuModel');



const getAllItems = async (req, res) => {
    res.json(await getAll_pg());
    console.log('sent json');
}

const getItemById = async (req, res) => {
    res.json(await getById_pg(parseInt(req.params.id)));
}

const updateItem = async (req, res) => {
    res.json(await update_pg(req.body.id, req.body.name, req.body.description, req.body.price) == 0 ? { success: false } : { success: true });
}

const createItem = async (req, res) => {
    res.json(await insert_pg(req.body.name, req.body.description, req.body.price) == 0 ? { success: false } : { success: true })
}

const deleteItem = async (req, res) => {
    res.json(await delete_pg(req.body.id) == 0 ? { success: false } : { success: true })
}

module.exports = { getAllItems, getItemById, updateItem, createItem, deleteItem };