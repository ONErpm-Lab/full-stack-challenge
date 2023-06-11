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
    TrackRepository.listAll = jest.fn();
    TrackRepository.listAll.mockRejectValue("error");

    expect(TrackService.listAll()).rejects.toMatch("error");
  })
})