import { HttpClientModule } from '@angular/common/http';
import { async, ComponentFixture, TestBed } from '@angular/core/testing';
import { BrowserModule } from '@angular/platform-browser';
import { AppRoutingModule } from 'src/app/app-routing.module';
import { SongsService } from 'src/app/services/songs.service';

import { SongsWrapperComponent } from './songs-wrapper.component';

describe('SongsWrapperComponent', () => {
  let component: SongsWrapperComponent;
  let fixture: ComponentFixture<SongsWrapperComponent>;
  let service: SongsService;
  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ SongsWrapperComponent ],
      providers: [{
        provide: SongsService
      }],
      imports: [
        BrowserModule,
        AppRoutingModule,
        HttpClientModule,
      ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(SongsWrapperComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();

    service = TestBed.get(SongsService);
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });

  it(`should render title as 'Song list'`, async(() => {
    const compiled = fixture.debugElement.nativeElement;
    expect(compiled.querySelector('h1').textContent).toContain('Song list')
  }));

  it('should call getAllSongs method on init', () => {

    const userServiceSpy = spyOn(service, 'getAllSongs').and.callThrough();
    const componentSpy = spyOn(component, 'getSongs').and.callThrough();
  

    expect(userServiceSpy).not.toHaveBeenCalled();
    expect(componentSpy).not.toHaveBeenCalled();
  
    component.ngOnInit();
  
    expect(userServiceSpy).toHaveBeenCalledTimes(1);
    expect(componentSpy).toHaveBeenCalledTimes(1);
  });
});
