import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Observable } from 'rxjs';
import { Track } from './apiModel';

@Injectable({
  providedIn: 'root'
})
export class ApiService {

  constructor(private http: HttpClient) { }

  searchInDb(isrc: string): Observable<Track> {
    let headers = new HttpHeaders();
    headers = headers.set(
      'Authorization',
      'Bearer' + '${}'
    );
    return this.http.post<Track>(
      `http://localhost:3000/tracks/`,
      { isrc: isrc},
      { headers: headers }
    );
  }

  listDbTracks(): Observable<Track[]> {
    let headers = new HttpHeaders();
    return this.http.get<Track[]>(
      `http://localhost:3000/tracks/`,
      { headers: headers }
    )
  }
}
