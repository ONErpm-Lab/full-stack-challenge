import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';
import { AppComponent } from './app.component';
import { AppRoutingModule } from './app-routing.module';
import { CoreModule } from './core/core.module';
import { HomeComponent } from './routes/home/home.component';
import { TrackSaveComponent } from './routes/track-save/track-save.component';
import { TrackListComponent } from './routes/track-list/track-list.component';



@NgModule({
  declarations: [
    AppComponent,
    HomeComponent,
    TrackSaveComponent,
    TrackListComponent,
  ],
  imports: [BrowserModule, AppRoutingModule, CoreModule],
  bootstrap: [AppComponent],
})
export class AppModule { }
