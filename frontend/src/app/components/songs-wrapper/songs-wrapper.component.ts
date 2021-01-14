import { Component, OnInit } from '@angular/core';
import { HttpClient } from '@angular/common/http';

@Component({
  selector: 'app-songs-wrapper',
  templateUrl: './songs-wrapper.component.html',
  styleUrls: ['./songs-wrapper.component.scss']
})
export class SongsWrapperComponent implements OnInit {

  private urlHost = 'http://localhost:8000/api/';

  songs: any [];
  constructor(
    private http: HttpClient
  ) { }

  ngOnInit(): void {
    this.getSongs();
  }

  getSongs() {
    const url = this.urlHost + 'get-songs';
    this.http.get(url)
    .subscribe( (data: any[]) => {
      this.songs = data;
    })
  }

}
