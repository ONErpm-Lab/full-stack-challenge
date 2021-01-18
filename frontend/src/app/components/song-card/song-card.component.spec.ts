import { Component } from '@angular/core';
import { async, ComponentFixture, TestBed } from '@angular/core/testing';
import { By } from '@angular/platform-browser';
import { Ms2minutesPipe } from 'src/app/pipes/ms2minutes.pipe';

import { SongCardComponent } from './song-card.component';


describe('SongCardComponent', () => {
  let component: SongCardComponent;
  let fixture: ComponentFixture<SongCardComponent>;

  const testSong = {
    brasil_available: true,
    duration: 177626,
    isrc: "BR1SP1200071",
    artists: [{
      artist_name: "Gó Gó Boys",
      song_id: 3
    }],
    preview_link: "https://p.scdn.co/mp3-preview/0de61e71bc274f63b02af24faaa7434f9082a3d7?cid=21f57101fa934d13b2b533c43d48d649",
    release_date: "2014-03-25 00:00:00",
    spotify_link: "https://open.spotify.com/track/4s71Bub5KzXBSMyE8nlH4E",
    title: "É pra Você",
  };

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ 
        SongCardComponent,
        Ms2minutesPipe]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(SongCardComponent);
    component = fixture.debugElement.componentInstance;
    component.song = testSong;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });

  it('should show song name', () => {
    const compiled = fixture.debugElement.query(By.css('.song-name'));
    expect(compiled.nativeElement.innerHTML).toContain(testSong.title);
  })

  it('should show song duration', () => {
    const compiled = fixture.debugElement.query(By.css('.duration'));
    expect(compiled.nativeElement.innerHTML).toContain('2:58');
  })

  it('should show release date', () => {
    const compiled = fixture.debugElement.query(By.css('.release-date'));
    expect(compiled.nativeElement.innerHTML).toContain('March 25, 2014');
  })

  it('should show artists', () => {
    const compiled = fixture.debugElement.query(By.css('.artists'));
    for(let artist of testSong.artists) {
      expect(compiled.nativeElement.innerHTML).toContain(artist.artist_name);
    }
  })

  it( `should show 'Brasil available' text in green when available`, () => {
    const compiled = fixture.debugElement.query(By.css('.green'));
    expect(compiled.nativeElement.querySelector('span')).not.toContain('not');
  })

});


describe('SongCardComponent', () => {
  let component: SongCardComponent;
  let fixture: ComponentFixture<SongCardComponent>;

  const testSong = {
    album_cover: "https://i.scdn.co/image/ab67616d000048511cd3135bb70b14104ad5cec6",
    artists: [
    {song_id: 7, artist_name: "DJ Malibu"},
    {song_id: 7, artist_name: "MC Pack"},
    {song_id: 7, artist_name: "MC Gui Andrade"}],
    artist_name: "MC Gui Andrade",
    song_id: 7,
    brasil_available: false,
    duration: 124315,
    isrc: "BXKZM1900345",
    preview_link: "https://p.scdn.co/mp3-preview/83f4d469ae420e45a2fb0c7fb78ec1038c0de055?cid=21f57101fa934d13b2b533c43d48d649",
    release_date: "2019-10-05 00:00:00",
    spotify_link: "https://open.spotify.com/track/5w4O21KEy5RBVCiecgmSMo",
    title: "Louca",
  };

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ 
        SongCardComponent,
        Ms2minutesPipe]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(SongCardComponent);
    component = fixture.debugElement.componentInstance;
    component.song = testSong;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });

  it('should show song name', () => {
    const compiled = fixture.debugElement.query(By.css('.song-name'));
    expect(compiled.nativeElement.innerHTML).toContain(testSong.title);
  })

  it('should show song duration', () => {
    const compiled = fixture.debugElement.query(By.css('.duration'));
    expect(compiled.nativeElement.innerHTML).toContain('2:05');
  })

  it('should show release date', () => {
    const compiled = fixture.debugElement.query(By.css('.release-date'));
    expect(compiled.nativeElement.innerHTML).toContain('October 5, 2019');
  })

  it('should show artists', () => {
    const compiled = fixture.debugElement.query(By.css('.artists'));
    for(let artist of testSong.artists) {
      expect(compiled.nativeElement.innerHTML).toContain(artist.artist_name);
    }
  })

  it( `should show 'Brasil available' text in green when available`, () => {
    const compiled = fixture.debugElement.query(By.css('.red'));
    expect(compiled.nativeElement.querySelector('span').innerHTML).toContain('not');
  })

});
