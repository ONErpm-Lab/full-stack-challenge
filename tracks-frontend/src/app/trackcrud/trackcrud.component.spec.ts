import { ComponentFixture, TestBed } from '@angular/core/testing';

import { TrackcrudComponent } from './trackcrud.component';

describe('TrackcrudComponent', () => {
  let component: TrackcrudComponent;
  let fixture: ComponentFixture<TrackcrudComponent>;

  beforeEach(() => {
    TestBed.configureTestingModule({
      declarations: [TrackcrudComponent]
    });
    fixture = TestBed.createComponent(TrackcrudComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
