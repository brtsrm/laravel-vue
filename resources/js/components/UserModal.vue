<template>
  <div
    class="modal fade"
    id="userModal"
    tabindex="-1"
    role="dialog"
    aria-labelledby="userModal"
    aria-hidden="true"
  >
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5
            class="modal-title"
            v-text="item.id > 0 ? 'Kullanıcı Düzenle' : 'Yeni Kullanıcı Ekle'"
          >
            Modal title
          </h5>
          <button
            type="button"
            class="close"
            data-dismiss="modal"
            aria-label="Close"
          >
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div
            v-if="errorMessage"
            class="alert alert-danger"
            v-html="errorMessage"
          ></div>
          <form @submit.prevent="true">
            <div class="form-group row">
              <label for="kullaniciadi" class="col-sm-12 col-form-label"
                >Kullanıcı Adı</label
              >
              <div class="col-sm-12">
                <input
                  type="text"
                  class="form-control"
                  name="name"
                  id="kullaniciadi"
                  placeholder=""
                  v-model="item.name"
                />
              </div>
            </div>
            <div class="form-group row">
              <label for="sifre" class="col-sm-12 col-form-label">Şifre</label>
              <div class="col-sm-12">
                <input
                  type="password"
                  class="form-control"
                  name="password"
                  id="sifre"
                  placeholder=""
                  v-model="item.password"
                />
              </div>
            </div>
            <div class="form-group row">
              <label for="email" class="col-sm-12 col-form-label">Email</label>
              <div class="col-sm-12">
                <input
                  type="email"
                  class="form-control"
                  name="email"
                  id="email"
                  placeholder=""
                  v-model="item.email"
                />
              </div>
            </div>
            <div class="form-group row">
              <div class="col-sm-12">
                <button
                  type="submit"
                  class="btn btn-primary w-100"
                  @click="saveItem()"
                  v-text="item.id > 0 ? 'Düzenle' : 'Kaydet'"
                >
                  Kaydet
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ["item"],
  data() {
    return {
      errorMessage: "",
    };
  },
  methods: {
    saveItem() {
      if (this.item.id > 0) {
        axios
          .put("/users/" + this.item.id, this.item)
          .then((response) => {
            if (response.data.success) {
              this.$emit("onSaved", this.item);
              toastr.success("Kaydı Güncellendi", "Kullanıcı");
              $("#userModal").modal("hide");
            }
          })
          .catch((error) => {
            if (error.response.data.errors) {
              this.errorMessage += "<ul>";
              Object.keys(error.response.data.errors).forEach((key) => {
                this.errorMessage +=
                  "<li>" + error.response.data.errors[key][0] + "</li>";
              });
              this.errorMessage += "</ul>";
            }
          });
      } else {
        axios
          .post("/users", this.item)
          .then((response) => {
            if (response.data.success) {
              this.$emit("onSaved", this.item);
              $("#userModal").modal("hide");
              toastr.success("Kaydı Ekledi", "Kullanıcı");
            }
          })
          .catch((error) => {
            if (error.response.data.errors) {
              this.errorMessage += "<ul>";
              Object.keys(error.response.data.errors).forEach((key) => {
                this.errorMessage +=
                  "<li>" + error.response.data.errors[key][0] + "</li>";
              });
              this.errorMessage += "</ul>";
            }
          });
      }
    },
  },
};
</script>

<style>
</style>