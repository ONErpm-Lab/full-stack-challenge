import { HttpClientModule } from '@angular/common/http';
import { TestBed } from '@angular/core/testing';
import { BrowserModule } from '@angular/platform-browser';
import { AppRoutingModule } from '../app-routing.module';

import { SongsService } from './songs.service';

describe('SongsService', () => {
  let service: SongsService;

  beforeEach(() => {
    TestBed.configureTestingModule({
      imports: [
        BrowserModule,
        HttpClientModule,
      ]});
    service = TestBed.inject(SongsService);
  });

  it('should be created', () => {
    expect(service).toBeTruthy();
  });

  it('should get the data successfully', (done: DoneFn) => {
    service.getAllSongs().subscribe((data) => {
      expect(data).toBeTruthy();
      done();
    });
  });

  it('songs should be in alphabetical order', (done: DoneFn) => {
    service.getAllSongs().subscribe((songs: any[]) => {
      let valid = true;
      for(let i = 0; i<songs.length-1; i++) {
        console.log(i);
        const currentSong = songs[i];
        const nextSong = songs[i+1];
        valid = valid && currentSong.title <= nextSong.title;
      }
      expect(valid).toBeTruthy();
      done();

    });
  });
});
