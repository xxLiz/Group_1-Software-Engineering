const { Client } = require('pg');
require('dotenv').config();

const getClient = async () => {
  const client = new Client({
    host: 'dpg-cnj0c7njbltc73c7itj0-a.oregon-postgres.render.com',
    port: '5432',
    user: 'csci841_f2024_db_1_user',
    password: 'nAfCxVtD0GMcUg1xKdvJhDrcDSS0UFhO',
    database: 'csci841_f2024_db_1',
    ssl: true,
  });
  await client.connect();
  return client;
};

module.exports = { getClient };
