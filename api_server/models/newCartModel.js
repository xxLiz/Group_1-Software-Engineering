const { getClient } = require('./db');

const getAll_pg = async (user) => {
    const pgsql = await getClient();

    const entries = await pgsql.query('SELECT cart_separated.id, cart_separated.notes, cart_separated.menuitem_id AS id_in_menu, menuitem.name, menuitem.description, menuitem.price FROM cart_separated JOIN menuitem ON cart_separated.menuitem_id = menuitem.id WHERE cart_separated.user = $1 ORDER BY menuitem.name, cart_separated.id;', [user]);
    await pgsql.end();

    return entries.rows;
};

const getById_pg = async (user, id) => {
    const pgsql = await getClient();

    const entries = await pgsql.query('SELECT cart_separated.id, cart_separated.notes, cart_separated.menuitem_id AS id_in_menu, menuitem.name, menuitem.description, menuitem.price FROM cart_separated JOIN menuitem ON cart_separated.menuitem_id = menuitem.id WHERE cart_separated.id = $1 AND cart_separated.user = $2', [id, user]);
    await pgsql.end();

    return entries.rows[0] ? entries.rows[0] : {};
};

const update_pg = async (user, id, notes) => {
    const pgsql = await getClient();

    const entries = await pgsql.query('UPDATE cart_separated SET notes = $1 WHERE id = $2 AND "user" = $3;',
                                    [notes, id, user]);
    await pgsql.end();

    return entries.rowCount;
};

const insert_pg = async (user, notes, id_in_menu) => {
    const pgsql = await getClient();
    const entries = await pgsql.query('INSERT INTO cart_separated (notes, menuitem_id, "user") VALUES ($1, $2, $3)', [notes, id_in_menu, user]);
    await pgsql.end();

    return entries.rowCount;
}

const delete_pg = async (user, id) => {
    const pgsql = await getClient();

    const entries = await pgsql.query('DELETE FROM cart_separated WHERE id = $1 AND user = $2', [id, user]);
    await pgsql.end();
    return entries.rowCount;
}

module.exports = { getAll_pg, getById_pg, update_pg, insert_pg, delete_pg };
