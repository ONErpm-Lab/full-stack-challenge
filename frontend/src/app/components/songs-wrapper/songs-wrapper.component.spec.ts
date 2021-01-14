import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { SongsWrapperComponent } from './songs-wrapper.component';

describe('SongsWrapperComponent', () => {
  let component: SongsWrapperComponent;
  let fixture: ComponentFixture<SongsWrapperComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ SongsWrapperComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(SongsWrapperComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
