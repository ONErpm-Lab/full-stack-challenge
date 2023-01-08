import { Component, Input, OnInit } from '@angular/core';
import { Meta, Title } from '@angular/platform-browser';
import { ISEO } from '../../interfaces/seo.inteface';

@Component({
  selector: 'app-seo',
  template: ''
})
export class SeoComponent implements OnInit {

  constructor(private titleService: Title, private metaService: Meta) { }

  ngOnInit(): void {
    const url = this.options?.url || 'https://onerpm-full-stack-challenge.vercel.app/';
    const title = this.options?.title || 'Fullstack Challenge!';
    const description = this.options?.description || 'ONErpm Fullstack Challenge | Backend (Laravel) + Frontend (Angular)';
    const metaImage = this.options?.metaImage || 'https://onerpm-full-stack-challenge.vercel.app/assets/logo.png';

    this.titleService.setTitle(title);
    this.metaService.addTags([
      {name: 'description', content: description},
      {name: 'og:type', content: 'website'},
      {name: 'og:url', content: url},
      {name: 'og:title', content: title},
      {name: 'og:description', content: description},
      {name: 'og:image', content: metaImage},
      {name: 'twitter:card', content: 'summary_large_image'},
      {name: 'twitter:url', content: url},
      {name: 'twitter:title', content: title},
      {name: 'twitter:description', content: description},
      {name: 'twitter:image', content: metaImage},
    ]);
  }

  @Input() options: ISEO = {};

}
