const express = require('express');
const router = express.Router();
const cartController = require('../controllers/cartController');

router.route('/')
    .get(cartController.getAllItems)
    .post(cartController.createItem)
    .put(cartController.updateItem)
    .delete(cartController.deleteItem);

router.route('/:id')
    .get(cartController.getItemById);

module.exports = router;