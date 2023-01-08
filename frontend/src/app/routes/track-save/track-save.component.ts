import { Component, OnInit } from '@angular/core';
import { FormBuilder } from '@angular/forms';
import { BackendService } from 'src/app/core/services/backend.service';
import { SpotifyService } from 'src/app/core/services/spotify.service';
import { UtilsService } from 'src/app/core/services/utils.service';



@Component({
  selector: 'app-reactive-form',
  templateUrl: './track-save.component.html'
})
export class TrackSaveComponent implements OnInit {

  constructor(
    private readonly fb: FormBuilder,
    private readonly spotifyService: SpotifyService,
    private readonly utilsService: UtilsService,
    private readonly backendService: BackendService,
  ) { }

  submitted: boolean = false;

  form = this.fb.group({
    isrc: [],
    debug: [false],
  });

  spotifyTracks: any[] = [];

  ngOnInit(): void { }

  async onSubmit() {
    this.submitted = true;

    const isrc = String(this.form.value.isrc);
    const tracks = await this.spotifyService.getTracksByISRC(isrc);

    if(!tracks) return;

    this.spotifyTracks = tracks.items;
  }

  millisecondsToMinutes(milliseconds: number) {
    return this.utilsService.millisecondsTommssFormat(milliseconds);
  }

  isBrAvaiable(track: SpotifyApi.TrackObjectFull) {
    return this.utilsService.isAvaiable("BR", track);
  }

  async onClickSave(track: SpotifyApi.TrackObjectFull) {
    await this.backendService.saveTrack(track);
  }
}
