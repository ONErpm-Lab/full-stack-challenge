const DBClient = require("../db/DBClient");

const findByISRC = async (isrc) => {
  return DBClient.track.findUnique({
    where: { isrc: isrc }
  });
}

const save = async (track) => {
  return DBClient.track.create({ data: track });
}

const listAll = async (orderBy) => {
  return DBClient.track.findMany({
    orderBy
  });
}

module.exports = { findByISRC, save, listAll }