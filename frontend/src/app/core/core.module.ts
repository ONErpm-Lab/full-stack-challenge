import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { HeaderModule } from './header/header.module';
import { FooterModule } from './footer/footer.module';
import { FormDebugModule } from './form-debug/form-debug.module';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';
import { SeoModule } from './seo/seo.module';
import { HttpClientModule } from '@angular/common/http';

const coreModules = [
  FormsModule,
  ReactiveFormsModule,
  SeoModule,
  HeaderModule,
  FooterModule,
  FormDebugModule,
  HttpClientModule,
];

@NgModule({
  declarations: [],
  imports: [CommonModule, ...coreModules],
  exports: [...coreModules]
})
export class CoreModule { }
