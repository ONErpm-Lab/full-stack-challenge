import { Injectable } from '@angular/core';

@Injectable({
  providedIn: 'root'
})
export class UtilsService {

  constructor() { }

  millisecondsTommssFormat(milliseconds: number) {
    const totalSeconds = Math.ceil(milliseconds / 1000);

    const minutes = Math.floor(totalSeconds / 60);

    const seconds = totalSeconds - minutes * 60;

    const mmssFormat = `${minutes.toString().padStart(2, "0")}:${seconds.toString().padStart(2, "0")}`;

    return mmssFormat;
  }

  isAvaiable(country: string, track: SpotifyApi.TrackObjectFull) {
    return Boolean(track.available_markets?.filter(market => market === country).length);
  }
}
