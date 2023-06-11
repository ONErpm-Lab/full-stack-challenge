import { Component, OnInit } from '@angular/core';
import { FormControl, FormGroup } from '@angular/forms';
import { ApiService } from 'src/app/services/api.service';
import { Track } from 'src/app/services/apiModel';

@Component({
  selector: 'app-list',
  templateUrl: './list.component.html',
  styleUrls: ['./list.component.css']
})
export class ListComponent implements OnInit {

  constructor(private apiService: ApiService) { };

  trackList: Track[] = [];

  isrcForm = new FormGroup({
    isrc: new FormControl('')
  });

  showModal = false

  message = "";
  list() {
    this.apiService.listDbTracks().subscribe((result) => {
      this.trackList = result;
      console.log(this.trackList[0].link_spotify)
    })
  }

  ngOnInit() {this.list()}

  searchInDb() {
    if (this.isrcForm.valid) {
      //verificar no formgroup valores nao nulos
      this.apiService.searchInDb(this.isrcForm.value.isrc!).subscribe({
        next: (data: Track) => {
          console.log("deu bom ", data)
          this.message = `ISRC ${this.isrcForm.value.isrc} created successfuly`
          this.showModal = true
        }, error: (error) => {
          console.log("deu ruim ", error)
          this.message = error.error.message
          this.showModal = true
        }
      })
    }
  }

  hideModal() {
    this.showModal = false
    this.isrcForm.reset()
    this.list()
  }
}
