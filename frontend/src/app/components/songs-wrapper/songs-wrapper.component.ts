import { Component, OnInit } from '@angular/core';
import { HostListener } from '@angular/core';
import { SongsService } from 'src/app/services/songs.service';

@Component({
  selector: 'app-songs-wrapper',
  templateUrl: './songs-wrapper.component.html',
  styleUrls: ['./songs-wrapper.component.scss']
})
export class SongsWrapperComponent implements OnInit {

 
  //Aray of songs
  songs: any [];


  constructor(
    private songsService: SongsService
  ) { }

  ngOnInit(): void {
    this.getSongs();
  }

  /**
   * Retrieves sogn list from backend
   */
  getSongs() {
    this.songsService.getAllSongs()
    .subscribe( (data: any) => {
      this.songs = data.data;
    })
  }

}
