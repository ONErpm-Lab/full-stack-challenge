import { Injectable } from '@angular/core';

import Swal from "sweetalert2";

@Injectable({
  providedIn: 'root'
})
export class AlertService {
  private readonly alert = Swal;

  async onSaveSuccess(model: string) {
    return this.alert.fire({
      allowOutsideClick: false,
      allowEnterKey: false,
      allowEscapeKey: false,
      icon: "success",
      title: "Success!",
      text: `${model} saved!`,
    });
  }

  async onSaveError(model: string) {
    return this.alert.fire({
      allowOutsideClick: false,
      allowEnterKey: false,
      allowEscapeKey: false,
      icon: "error",
      title: "Error!",
      text: `${model} was not saved, please contact the IT sector!`,
    });
  }

  async onInvalidForm() {
    return this.alert.fire({
      allowOutsideClick: false,
      allowEnterKey: false,
      allowEscapeKey: false,
      icon: "error",
      title: "Invalid!",
      text: "The form is invalid, please check the fields!",
    });
  }

  async onError() {
    return this.alert.fire({
      allowOutsideClick: false,
      allowEnterKey: false,
      allowEscapeKey: false,
      icon: "error",
      title: "Error!",
      text: "Ops, there was an error, please contact the IT sector!",
    });
  }

  async onClickDelete(model: string) {
    return this.alert.fire({
      allowOutsideClick: false,
      allowEnterKey: false,
      allowEscapeKey: false,
      icon: "warning",
      title: "Warning!",
      text: `You are about to delete a ${model}, are you sure?`,
      confirmButtonText: "Yes, delete!",
      denyButtonText: "No, don't delete!",
      showDenyButton: true,
    });
  }

  async onDeleteSuccess(model: string) {
    return this.alert.fire({
      allowOutsideClick: false,
      allowEnterKey: false,
      allowEscapeKey: false,
      icon: "success",
      title: "Success!",
      text: `${model} deleted!`,
    });
  }

  async onDeleteError(model: string) {
    return this.alert.fire({
      allowOutsideClick: false,
      allowEnterKey: false,
      allowEscapeKey: false,
      icon: "error",
      title: "Error!",
      text: `${model} was not deleted!`,
    });
  }
}
