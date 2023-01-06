import { Component, Input, OnInit } from '@angular/core';
import { FormGroup, NgForm } from '@angular/forms';

@Component({
  selector: 'app-form-debug',
  templateUrl: './form-debug.component.html'
})
export class FormDebugComponent implements OnInit {

  constructor() { }

  ngOnInit(): void { }

  @Input() form!: NgForm | FormGroup;

}
