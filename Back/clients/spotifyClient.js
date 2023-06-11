const axios = require("axios");
const querystring = require('querystring');

const getSpotifyToken = async () => {
  return await axios({
    method: "post",
    url: "https://accounts.spotify.com/api/token",
    headers: { 'content-type': 'application/x-www-form-urlencoded' },
    data: querystring.stringify({
      grant_type: "client_credentials",
      client_id: "77826ab8d3124c6fbb05317b27f3e34a",
      client_secret: "f182c0c42a3b40a5bc0ea07f52fd26f9"
    }),
  }).then((result) => {
    console.log(result)
    return result.data.access_token
  })
}

const getSpotifyTrack = async (isrc) => {
  const token = await getSpotifyToken();

  const track = await axios({
    method: "get",
    url: `https://api.spotify.com/v1/search?q=isrc:${isrc}&type=track`,
    headers: {
      "Content-Type": "application/json",
      authorization: `Bearer ${token}`,
    },
  }).then((result) => {
    return result.data;
  })
  return track
}

module.exports = { getSpotifyTrack }