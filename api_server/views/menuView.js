const express = require('express');
const router = express.Router();
const menuController = require('../controllers/menuController');

router.route('/')
    .get(menuController.getAllItems)
    .post(menuController.createItem)
    .put(menuController.updateItem)
    .delete(menuController.deleteItem);

router.route('/:id')
    .get(menuController.getItemById);

module.exports = router;