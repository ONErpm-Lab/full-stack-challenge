import { Injectable } from '@angular/core';
import {
  HttpRequest,
  HttpHandler,
  HttpEvent,
  HttpInterceptor,
  HttpErrorResponse,
} from '@angular/common/http';
import { catchError, Observable, throwError } from 'rxjs';
import { AlertService } from '../services/alert.service';

@Injectable()
export class HttpErrorInterceptor implements HttpInterceptor {

  constructor(
    private readonly alertService: AlertService,
  ) {}

  intercept(request: HttpRequest<unknown>, next: HttpHandler): Observable<HttpEvent<unknown>> {
    return next.handle(request).pipe(catchError((response: HttpErrorResponse) => {
      if (response.status >= 400 && response.status !== 404) {
        this.alertService.onError();
      }

      if (response.status === 0) this.alertService.onError(
        "Backend is down!",
        "Backend server could not be accessed, please contact the IT sector!",
      )

      return throwError(() => response);
    }));
  }
}
