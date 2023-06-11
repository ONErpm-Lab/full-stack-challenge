const express = require("express");
const TrackController = require("../controllers/trackController");

const router = express.Router();

router.post("/tracks", TrackController.createTrack);
router.get("/tracks", TrackController.listAll)

module.exports = router;