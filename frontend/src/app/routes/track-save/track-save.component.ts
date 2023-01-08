import { Component, OnInit } from '@angular/core';
import { FormBuilder } from '@angular/forms';
import { AlertService } from 'src/app/core/services/alert.service';
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
    private readonly alertService: AlertService,
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
  
    if (this.form.invalid) {
      await this.alertService.onInvalidForm();
      return;
    }

    const isrc = String(this.form.value.isrc);
    const tracks = await this.spotifyService.getTracksByISRC(isrc);

    if (!tracks) return;

    this.spotifyTracks = tracks.items;
  }

  millisecondsToMinutes(milliseconds: number) {
    return this.utilsService.millisecondsTommssFormat(milliseconds);
  }

  isBrAvaiable(track: SpotifyApi.TrackObjectFull) {
    return this.utilsService.isAvaiable("BR", track);
  }

  async onClickSave(track: SpotifyApi.TrackObjectFull) {
    try {
      await this.backendService.saveTrack(track);
      await this.alertService.onSaveSuccess("Track");
    } catch (error) {
      await this.alertService.onSaveError("Track");
    }
  }
}
