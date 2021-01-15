import { Component, OnInit } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { HostListener } from '@angular/core';

@Component({
  selector: 'app-songs-wrapper',
  templateUrl: './songs-wrapper.component.html',
  styleUrls: ['./songs-wrapper.component.scss']
})
export class SongsWrapperComponent implements OnInit {

  private urlHost = 'http://localhost:8000/api/';

  songs: any [];
  wrapperWidth;
  constructor(
    private http: HttpClient
  ) { }

  ngOnInit(): void {
    this.getSongs();
    this.setWrapperWidth(window.innerWidth);
  }

  getSongs() {
    const url = this.urlHost + 'get-songs';
    this.http.get(url)
    .subscribe( (data: any) => {
      this.songs = data.data;
    })
  }

  setWrapperWidth(width) {
    const w = Math.floor(width/436)*436;
    this.wrapperWidth = w == 0 ? width : w.toString() + 'px';
  }

  @HostListener('window:resize', ['$event'])
  onResize(event) {
    this.setWrapperWidth(window.innerWidth);
  }

}
