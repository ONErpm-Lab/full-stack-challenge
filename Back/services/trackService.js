const SpotifyClient = require("../clients/spotifyClient");
const TrackRepository = require("../repositories/trackRepository");

const trackFromSpotifyTrack = (spotifyTrack) => {

  //album
  const album = spotifyTrack.album;
  // artists
  const allArtists = spotifyTrack.artists.map((artist)=>artist.name).join();

  const convertedTrack = {
    isrc : spotifyTrack.external_ids.isrc,
    artists : allArtists,
    thumb: album.images.find((image)=>image.height===64)?.url,
    release_date: new Date(album.release_date),
    name : spotifyTrack.name,
    duration : spotifyTrack.duration_ms,
    link_preview : spotifyTrack.preview_url,
    link_spotify : spotifyTrack.external_urls.spotify,
    available_in_brazil: !!spotifyTrack.available_markets.find((market)=>market==="BR")
  };

  console.log("Converted track :: ", convertedTrack)

  return convertedTrack;
}

const findByISRC = async (isrc) => {

    const existingTrack = await TrackRepository.findByISRC(isrc);
    console.log(existingTrack)

    if (existingTrack) throw new Error("This track is already exists")

    const spotifyResult = await SpotifyClient.getSpotifyTrack(isrc);
    console.log("Found spotify track :: " , spotifyResult)

    if (spotifyResult.tracks.total === 0) throw new Error("ISRC not found.")

    const newTrack = TrackRepository.save(trackFromSpotifyTrack(spotifyResult.tracks.items[0]));

    return newTrack;
}

const listAll = async() => {
  return await TrackRepository.listAll({ name : "asc" })
}

module.exports = { findByISRC, listAll };