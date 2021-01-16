import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';

@Injectable({
  providedIn: 'root'
})
export class SongsService {

  private urlHost = 'https://quiet-lake-12452.herokuapp.com/api/';


  constructor(
    private http: HttpClient
  ) { }

  getAllSongs(){
    const url = this.urlHost + 'get-songs';
    return this.http.get(url);
  }
}
