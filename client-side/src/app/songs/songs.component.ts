import { Component, OnInit } from '@angular/core';
import { ApiService } from '../api.service';

@Component({
  selector: 'app-songs',
  templateUrl: './songs.component.html',
  styleUrls: ['./songs.component.css']
})
export class SongsComponent implements OnInit {
  songs;
  loading = true;

  constructor(private apiService: ApiService) { }

  ngOnInit(): void {
    this.apiService.getSongs().subscribe((data)=>{
      this.songs = data;
      this.loading = false;
    });
  }
}
