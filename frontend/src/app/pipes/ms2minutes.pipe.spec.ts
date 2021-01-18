import { Ms2minutesPipe } from './ms2minutes.pipe';

describe('Ms2minutesPipe', () => {
  let pipe;
  beforeEach(() => {
    pipe = new Ms2minutesPipe();
  })
  it('create an instance', () => {
    expect(pipe).toBeTruthy();
  });

  it('create an instance', () => {
    expect(pipe.transform(60000)).toBe('1:00');
  });

  it('create an instance', () => {
    expect(pipe.transform(6000)).toBe('0:06');
  });

  it('create an instance', () => {
    expect(pipe.transform(285965)).toBe('4:46 ');
  });
});
