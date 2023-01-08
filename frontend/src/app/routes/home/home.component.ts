import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';



@Component({
  selector: 'app-home',
  templateUrl: './home.component.html'
})
export class HomeComponent implements OnInit {

  constructor(
    private readonly router: Router,
  ) { }

  ngOnInit(): void { }

  goToCreateTracks() {
    this.router.navigate(['/tracks/save']);
  }

  goToListTracks() {
    this.router.navigate(['/tracks/list']);
  }
}
