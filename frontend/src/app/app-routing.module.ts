import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { SongsWrapperComponent } from './components/songs-wrapper/songs-wrapper.component';

const routes: Routes = [
  {path: '', component: SongsWrapperComponent},
  {path: '**', redirectTo: ''}
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
