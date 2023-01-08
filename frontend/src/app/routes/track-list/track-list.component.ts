import { Component, OnInit } from '@angular/core';
import { ITrack } from 'src/app/core/interfaces/track.interface';
import { AlertService } from 'src/app/core/services/alert.service';
import { BackendService } from 'src/app/core/services/backend.service';



@Component({
  selector: 'app-template-form',
  templateUrl: './track-list.component.html'
})
export class TrackListComponent implements OnInit {

  constructor(
    private readonly backendService: BackendService,
    private readonly alertService: AlertService,
  ) { }

  tracks: ITrack[] = [];

  async ngOnInit() {
    await this.getAllTracks();
  }

  async getAllTracks() {
    const tracks = await this.backendService.getAllTracks();

    this.tracks = tracks;
  }

  async onClickDelete(track: ITrack) {
    const result = await this.alertService.onClickDelete("Track");

    if(result.isDenied) return;

    try {
      await this.backendService.deleteTrack(track.id);
      await this.alertService.onDeleteSuccess("Track");
      await this.getAllTracks();
    } catch (error) {
      await this.alertService.onDeleteError("Track");
    }
  }
}
