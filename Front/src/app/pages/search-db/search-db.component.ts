import { Component } from '@angular/core';
import { FormControl, FormGroup } from '@angular/forms';
import { ApiService } from 'src/app/services/api.service';
import { Track } from 'src/app/services/apiModel';

@Component({
  selector: 'app-search-db',
  templateUrl: './search-db.component.html',
  styleUrls: ['./search-db.component.css']
})
export class SearchDbComponent {

  constructor(private apiService: ApiService) { }

  isrcForm = new FormGroup({
    isrc: new FormControl('')
  });

  message = "";

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
  }

  showModal = false
}
