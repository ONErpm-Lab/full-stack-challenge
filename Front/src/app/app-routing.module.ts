import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';

import { SearchDbComponent } from './pages/search-db/search-db.component';
import { ListComponent } from './pages/list/list.component';

const routes: Routes = [
  { path: '', pathMatch: 'full', redirectTo: 'list' },
  { path: 'list', component: ListComponent },
  { path: 'search', component: SearchDbComponent }
];

@NgModule({
  declarations: [],
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
