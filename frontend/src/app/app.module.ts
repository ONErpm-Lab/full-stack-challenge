import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';

import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { SongsWrapperComponent } from './components/songs-wrapper/songs-wrapper.component';
import { SongCardComponent } from './components/song-card/song-card.component';

@NgModule({
  declarations: [
    AppComponent,
    SongsWrapperComponent,
    SongCardComponent
  ],
  imports: [
    BrowserModule,
    AppRoutingModule
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }
