import { Component, OnInit } from '@angular/core';
import { ITrack } from 'src/app/core/interfaces/track.interface';
import { BackendService } from 'src/app/core/services/backend.service';
import { UtilsService } from 'src/app/core/services/utils.service';



@Component({
  selector: 'app-template-form',
  templateUrl: './track-list.component.html'
})
export class TrackListComponent implements OnInit {

  constructor(
    private readonly utilsService: UtilsService,
    private readonly backendService: BackendService,
  ) { }

  tracks: ITrack[] = [];

  async ngOnInit() {
    const tracks = await this.backendService.getAllTracks();

    this.tracks = tracks;
  }

  onClickDelete(track: ITrack) { }
}
