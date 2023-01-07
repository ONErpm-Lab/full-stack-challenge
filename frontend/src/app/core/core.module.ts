import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';
import { HttpClientModule } from '@angular/common/http';

import { FooterModule } from './components/footer/footer.module';
import { FormDebugModule } from './components/form-debug/form-debug.module';
import { HeaderModule } from './components/header/header.module';
import { SeoModule } from './components/seo/seo.module';

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
