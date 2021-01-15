import { Pipe, PipeTransform } from '@angular/core';

@Pipe({
  name: 'ms2minutes'
})
export class Ms2minutesPipe implements PipeTransform {

  transform(value: number): string {
    const totalSeconds = value/1000;
    const minutes = Math.floor(totalSeconds/60);
    const seconds = Math.ceil(totalSeconds%60);
    return minutes.toString() + ':' + seconds.toString();
  }

}
