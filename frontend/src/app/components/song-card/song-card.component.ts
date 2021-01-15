import { Component, Input, OnInit } from '@angular/core';

@Component({
  selector: 'app-song-card',
  templateUrl: './song-card.component.html',
  styleUrls: ['./song-card.component.scss']
})
export class SongCardComponent implements OnInit {

  @Input() song;


  //represetns wether the current song is available in brazil or not
  brasilAvailable;
  constructor() {     
  }

  ngOnInit(): void {
    this.brasilAvailable = this.song.brasil_available === 1;
  }

}
