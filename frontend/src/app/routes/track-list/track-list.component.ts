import { Component, OnInit } from '@angular/core';
import { ITrack } from 'src/app/core/interfaces/track.interface';
import { AlertService } from 'src/app/core/services/alert.service';
import { BackendService } from 'src/app/core/services/backend.service';
import { MockService } from 'src/app/core/services/mock.service';



@Component({
  selector: 'app-template-form',
  templateUrl: './track-list.component.html'
})
export class TrackListComponent implements OnInit {

  constructor(
    private readonly backendService: BackendService,
    private readonly alertService: AlertService,
    private readonly mockService: MockService,
  ) { }

  tracks: ITrack[] = [];

  async ngOnInit() {
    await this.getAllTracks();
  }

  async getAllTracks() {
    try {
      const tracks = await this.backendService.getAllTracks();
  
      this.tracks = tracks;
    } catch (error) {
      await this.alertService.onError(
        "Backend is down!",
        "Backend server could not be accessed, loading mock data...",
      );

      this.tracks = this.mockService.getAllTracks();
    }
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
