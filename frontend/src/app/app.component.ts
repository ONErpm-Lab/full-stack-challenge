import { Component } from '@angular/core';

@Component({
  selector: 'app-root',
  template: `
  <app-header></app-header>
  <div class="container" style="padding-top: 5rem;">
    <router-outlet></router-outlet>
  </div>
  <app-footer></app-footer>
  `
})
export class AppComponent {
  title = 'Fullstack Challenge!';
}
