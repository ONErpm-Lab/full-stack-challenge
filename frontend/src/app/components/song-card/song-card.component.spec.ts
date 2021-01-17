import { Component } from '@angular/core';
import { async, ComponentFixture, TestBed } from '@angular/core/testing';
import { Ms2minutesPipe } from 'src/app/pipes/ms2minutes.pipe';

import { SongCardComponent } from './song-card.component';

describe('SongCardComponent', () => {
  let component: TestHostComponent;
  let fixture: ComponentFixture<TestHostComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ 
        TestHostComponent,
        SongCardComponent,
        Ms2minutesPipe]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(TestHostComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });


  @Component({
    selector: `host-component`,
    template: `<app-song-card [song]="song"></app-song-card>`
  })
  class TestHostComponent {
    private song: any = {};

    setInput(song: any) {
      this.song = song;
    }
  }
});
