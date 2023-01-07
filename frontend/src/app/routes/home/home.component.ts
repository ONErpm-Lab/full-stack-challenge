import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { SpotifyService } from 'src/app/core/services/spotify.service';



@Component({
  selector: 'app-home',
  templateUrl: './home.component.html'
})
export class HomeComponent implements OnInit {

  constructor(
    private readonly router: Router,
    private readonly spotifyService: SpotifyService,
  ) { }

  ngOnInit(): void {
    this.spotifyService.login();
  }

  goToCreateTracks() {
    this.router.navigate(['/tracks/save']);
  }

  goToListTracks() {
    this.router.navigate(['/tracks/list']);
  }
}
