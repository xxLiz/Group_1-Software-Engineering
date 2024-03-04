const { getClient } = require('./db');

const getAll_pg = async () => {
    const pgsql = await getClient();

    const entries = await pgsql.query('SELECT cart.id, cart.notes, cart.menuitem_id AS id_in_menu, menuitem.name, menuitem.description, menuitem.price FROM cart JOIN menuitem ON cart.menuitem_id = menuitem.id;');
    await pgsql.end();

    return entries.rows;
};

const getById_pg = async (id) => {
    const pgsql = await getClient();

    const entries = await pgsql.query('SELECT cart.id, cart.notes, cart.menuitem_id AS id_in_menu, menuitem.name, menuitem.description, menuitem.price FROM cart JOIN menuitem ON cart.menuitem_id = menuitem.id WHERE cart.id = $1', [id]);
    await pgsql.end();

    return entries.rows[0] ? entries.rows[0] : {};
};

const update_pg = async (id, notes) => {
    const pgsql = await getClient();

    const entries = await pgsql.query('UPDATE cart SET notes = $1 WHERE id = $2',
                                    [notes, id]);
    await pgsql.end();

    return entries.rowCount;
};

const insert_pg = async (notes, id_in_menu) => {
    const pgsql = await getClient();

    const entries = await pgsql.query('INSERT INTO cart (notes, menuitem_id) VALUES ($1, $2)', [notes, id_in_menu]);
    await pgsql.end();

    return entries.rowCount;
}

const delete_pg = async (id) => {
    const pgsql = await getClient();

    const entries = await pgsql.query('DELETE FROM cart WHERE id = $1', [id]);
    await pgsql.end();
    return entries.rowCount;
}

module.exports = { getAll_pg, getById_pg, update_pg, insert_pg, delete_pg };