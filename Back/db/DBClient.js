const { PrismaClient } = require("@prisma/client");

const DBClient = new PrismaClient({
  errorFormat: "minimal",
  datasources: {
    db: {
      url:"mysql://root:admin@localhost:3306/onerpm" 
    },
  },
  log: [],
});

module.exports = DBClient;