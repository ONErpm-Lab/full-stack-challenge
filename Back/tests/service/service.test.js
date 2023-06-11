const TrackService = require("../../services/trackService");
const TrackRepository = require("../../repositories/trackRepository");
const { describe } = require("node:test");

jest.mock("../../repositories/trackRepository", () => jest.fn());

describe("Testing trackService.js", () => {
  it("should call repository and return track list", async() => {
    const trackList = [
      {
        isrc : "QZNJX2078148"
      }
    ];

    TrackRepository.listAll = jest.fn();
    TrackRepository.listAll.mockResolvedValue(trackList);

    const result = await TrackService.listAll();
    expect(result).toBe(trackList);
  });

  it("should throw error if the service list promise fails", async () => {
    
    const expectedError = new Error("Error listing tracks.");
    
    TrackRepository.listAll = jest.fn();
    TrackRepository.listAll.mockRejectedValue(expectedError);

    const error = await TrackService.listAll().catch(error=>error)
    expect(error).toStrictEqual(expectedError);
  })

  it("should throw error if the track already exists", async () => {
    
    const expectedError = new Error("This track is already exists");

    TrackRepository.findByISRC = jest.fn();
    TrackRepository.findByISRC.mockResolvedValue({name:"Track that already exists"});

    const error = await TrackService.findByISRC("ISRC").catch(error=>error)
    expect(error).toStrictEqual(expectedError);
  })
})