import { HttpClient } from '@angular/common/http';
import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-trackcrud',
  templateUrl: './trackcrud.component.html',
  styleUrls: ['./trackcrud.component.scss']
})
export class TrackcrudComponent implements OnInit {
  TrackArray : any = [] = [];
  isResultLoaded : boolean = false;
  isUpdateFormActive : boolean = false;

  isrcCode: string = "";

  album_thumb: string = "";
  release_date: string = "";
  track_title: string = "";
  artists: string[] = [];
  duration: string = "";
  audio_preview_url: string = "";
  spotify_track_url: string = "";
  is_available_in_br: boolean = false;

  currentTrackId = "";

  constructor(private http: HttpClient) { 
    this.getAllTracks();
  }

  ngOnInit(): void {
  }

  getAllTracks() {

    this.http.get('http://127.0.0.1:8005/api/tracks').subscribe((res: any) => {
      this.TrackArray = res.sort((a: any, b: any) => a.track_title.localeCompare(b.track_title));
      this.isResultLoaded = true;
    });

  }

register(){
    let bodyData = {
      "album_thumb": this.album_thumb,
      "release_date": this.release_date,
      "track_title": this.track_title,
      "artists": this.artists,
      "duration": this.duration,
      "audio_preview_url": this.audio_preview_url,
      "spotify_track_url": this.spotify_track_url,
      "is_available_in_br": this.is_available_in_br
    };
    
    this.http.post('http://127.0.0.1:8005/api/tracks', bodyData).subscribe((res: any) => {
      console.log(res);
      alert("Track saved successfully!");
      this.getAllTracks();
      this.album_thumb = "";
      this.release_date = "";
      this.track_title = "";
      this.artists = [];
      this.duration = "";
      this.audio_preview_url = "";
      this.spotify_track_url = "";
      this.is_available_in_br = false;
    });
  }

  save(){
    this.register();
  }

  getTrackInfo() {

    const url = `http://127.0.0.1:8005/api/spotify-tracks?isrc_code=${this.isrcCode}`;

    // Send a GET request to the backend with the entered ISRC code
    this.http.get(url).subscribe((response: any) => {
        this.setFormValues(response);
      },
      (error) => {
        console.error(error);
      }
    );
  }

  setFormValues(track: any) {
    this.album_thumb = track.album_thumb;
    this.release_date = track.release_date;
    this.track_title = track.track_title;
    this.artists = track.artists;
    this.duration = track.duration;
    this.audio_preview_url = track.audio_preview_url;
    this.spotify_track_url = track.spotify_track_url;
    this.is_available_in_br = track.is_available_in_br;
  }

  deleteTrack(trackId: any) {
    this.http.delete("http://127.0.0.1:8005/api/tracks/" + trackId).subscribe((res: any) => {
      alert("Track deleted successfully!");
      this.getAllTracks();
    });
  }

  copyToClipboard(value: string) {
    const textField = document.createElement('textarea');
    textField.innerText = value;
    document.body.appendChild(textField);
    textField.select();
    document.execCommand('copy');
    textField.remove();
  }

}
