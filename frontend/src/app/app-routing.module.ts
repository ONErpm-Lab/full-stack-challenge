import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { HomeComponent } from './routes/home/home.component';
import { TrackListComponent } from './routes/track-list/track-list.component';
import { TrackSaveComponent } from './routes/track-save/track-save.component';



const routes: Routes = [
  { path: '', redirectTo: 'home', pathMatch: "full" },
  { path: 'home', component: HomeComponent },
  { path: 'tracks/list', component: TrackListComponent },
  { path: 'tracks/save', component: TrackSaveComponent },
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
