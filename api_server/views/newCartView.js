const express = require('express');
const router = express.Router();
const cartController = require('../controllers/newCartController');

router.route('/:user')
    .get(cartController.getAllItems)
    .post(cartController.createItem)
    .put(cartController.updateItem)
    .delete(cartController.deleteItem);

module.exports = router;