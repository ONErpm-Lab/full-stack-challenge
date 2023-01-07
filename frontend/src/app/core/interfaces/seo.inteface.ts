export interface IFormData {
  firstname: string | null,
  lastname: string | null,
  username: string | null,
  agree: boolean | null,
  adress: {
    city: string | null,
    state: string | null,
    zip: string | null,
  },
}

export interface ISEO {
  url?: string,
  language?: string,
  title?: string,
  description?: string,
  favicon?: string,
  metaImage?: string,
}