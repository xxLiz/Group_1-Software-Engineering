const { getClient } = require('./db');

const getAll_pg = async () => {
    const pgsql = await getClient();
    console.log('got db connection');

    const entries = await pgsql.query('SELECT * FROM users;');
    await pgsql.end();
    console.log('closed db connection');

    return entries.rows;
};

const getById_pg = async (id) => {
    const pgsql = await getClient();

    const entries = await pgsql.query('SELECT * FROM users WHERE id = $1', [id]);
    await pgsql.end();

    return entries.rows[0];
};

const update_pg = async (id, fname, lname, email, address, zipcode, phone) => {
    const pgsql = await getClient();

    const entries = await pgsql.query('UPDATE users SET fname = $1, lname = $2, email = $3, adress = $4, zipcode = $5, phone = $6 WHERE id = $7',
                                    [fname, lname, email, address, zipcode, phone, id]);
    await pgsql.end();

    return entries.rowCount;
};

const insert_pg = async (fname, lname, email, address, zipcode, phone) => {
    const pgsql = await getClient();

    const entries = await pgsql.query('INSERT INTO users (fname, lname, email, address, zipcode, phone) VALUES ($1, $2, $3)', [fname, lname, email, address, zipcode, phone]);
    await pgsql.end();

    return entries.rowCount;
}

const delete_pg = async (id) => {
    const pgsql = await getClient();

    const entries = await pgsql.query('DELETE * FROM users WHERE id = $1', [id]);
    await pgsql.end();
    return entries.rowCount;
}

module.exports = { getAll_pg, getById_pg, update_pg, insert_pg, delete_pg };