const TrackService = require("../services/trackService");

const createTrack = async (req, res) => {
  try {
    const { body } = req;
    const { isrc } = body;

    if (!isrc || isrc.lenght < 12) throw new Error("Isrc incomplete");

    const result = await TrackService.findByISRC(isrc);
    res.status(201).json(result)

  } catch (error) {
    res.status(400).json(
      { "message": error.message }
    );
  }
};

const listAll = async (req, res) => {
  try {
    const result = await TrackService.listAll();
    res.status(200).json(result)

  } catch (error) {
    res.status(400).json(
      { "message": error.message }
    );
  }
};

module.exports = { createTrack, listAll } 