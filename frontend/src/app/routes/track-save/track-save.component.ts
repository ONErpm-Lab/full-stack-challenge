import { Component, OnInit } from '@angular/core';
import { FormBuilder } from '@angular/forms';



@Component({
  selector: 'app-reactive-form',
  templateUrl: './track-save.component.html'
})
export class TrackSaveComponent implements OnInit {

  constructor(private fb: FormBuilder) { }

  submitted: boolean = false;

  form = this.fb.group({
    firstname: [],
    lastname: [],
    username: [],
    debug: [true],
    address: this.fb.group({
      street: [],
      city: [],
      state: [''],
      zip: [],
    }),
  });

  ngOnInit(): void { }

  onSubmit(): void {
    this.submitted = true;
  }

}
