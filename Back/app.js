const express = require('express')
const app = express()
const cors = require('cors')
const port = 3000

app.use(express.json());
app.use(cors());
app.options('*', cors());
app.use(require("./routes"));

app.listen(port, () => {
  console.log(`Example app listening on port ${port}`)
})

module.exports = app;