import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';
import { HttpClientModule } from '@angular/common/http';

import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { SongsWrapperComponent } from './components/songs-wrapper/songs-wrapper.component';
import { SongCardComponent } from './components/song-card/song-card.component';
import { Ms2minutesPipe } from './pipes/ms2minutes.pipe';

@NgModule({
  declarations: [
    AppComponent,
    SongsWrapperComponent,
    SongCardComponent,
    Ms2minutesPipe
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    HttpClientModule,
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }
