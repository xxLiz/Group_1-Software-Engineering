const { getClient } = require('./db');

const getAll_pg = async () => {
    const pgsql = await getClient();
    console.log('got db connection');

    const entries = await pgsql.query('SELECT * FROM menuitem;');
    await pgsql.end();
    console.log('closed db connection');

    return entries.rows;
};

const getById_pg = async (id) => {
    const pgsql = await getClient();

    const entries = await pgsql.query('SELECT * FROM menuitem WHERE id = $1', [id]);
    await pgsql.end();

    return entries.rows[0] ? entries.rows[0] : {};
};

const update_pg = async (id, name, description, price) => {
    const pgsql = await getClient();

    const entries = await pgsql.query('UPDATE menuitem SET name = $1, description = $2, price = $3 WHERE id = $4',
                                    [name, description, price, id]);
    await pgsql.end();

    return entries.rowCount;
};

const insert_pg = async (name, description, price) => {
    const pgsql = await getClient();

    const entries = await pgsql.query('INSERT INTO menuitem (name, description, price) VALUES ($1, $2, $3)', [name, description, price]);
    await pgsql.end();

    return entries.rowCount;
}

const delete_pg = async (id) => {
    const pgsql = await getClient();

    const entries = await pgsql.query('DELETE FROM menuitem WHERE id = $1', [id]);
    await pgsql.end();
    return entries.rowCount;
}

module.exports = { getAll_pg, getById_pg, update_pg, insert_pg, delete_pg };