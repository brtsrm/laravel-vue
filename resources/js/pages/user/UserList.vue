<template>
  <div>

    <user-modal
      :item="item"
      ref="userModal"
      v-on:onSaved="refreshData"
    ></user-modal>

    <div class="btn btn-group float-right">
      <button @click="fetchData" class="btn btn-success">Yenile</button>
      <button @click="createData" class="btn btn-success">
        Yeni Kullanıcı
      </button>
    </div>
    <h1>Kullanıcılar</h1>
    <div v-if="errorMessage" class="alert alert-danger">
      {{ errorMessage }}
    </div>
    <table
      class="table table-bordered table-hover"
      v-if="list != null && list.length > 0"
    >
      <thead class="thead-inverse">
        <tr>
          <th>Id</th>
          <th>İsim</th>
          <th>Email</th>
          <th>İşlem</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(item, index) in list" :key="index">
          <td scope="row">{{ item.id }}</td>
          <td>{{ item.name }}</td>
          <td>{{ item.email }}</td>
          <td style="width: 25%">
            <button
              type="button"
              class="btn btn-primary"
              @click="editData(item.id)"
            >
              Düzenle
            </button>
            <button
              type="button"
              class="btn btn-danger"
              @click="deleteData(item.id)"
            >
              Sil
            </button>
          </td>
        </tr>
      </tbody>
    </table>
    <p v-else>Kayıt Bulunamadı</p>
    <pagination :meta="meta" v-on:pageChange="fetchData" />
  </div>
</template>

<script>
import Pagination from "../../components/Pagination.vue";
import UserModal from "../../components/UserModal.vue";
export default {
  components: { Pagination, UserModal },
  data() {
    return {
      list: null,
      item: null,
      errorMessage: null,
      meta: {},
    };
  },
  created() {
    this.fetchData();
  },
  methods: {
    fetchData(page = 1) {
      axios
        .get("/users", { params: { page } })
        .then((res) => {
          this.list = res.data.data;
          this.meta = res.data.meta;
          this.errorMessage = "";
        })
        .catch((error) => {
          this.errorMessage = error.response.data.message;
          this.list = [];
        });
    },
    editData(id) {
      axios
        .get("/users/" + id)
        .then((res) => {
          this.item = res.data;
          $("#userModal").modal("show");
          
          this.$refs.userModal.errorMessage;
          this.errorMessage = "";
        })
        .catch((error) => {
          console.log(error);
          this.errorMessage = error.res.data.message;
          this.list = [];
        });
    },
    createData() {
      this.item = {};
      this.$refs.userModal.errorMessage;
      $("#userModal").modal("show");
    },
    deleteData(id) {
      // tamda bura kanka
      // alert çalışyor 
      // sikerim ha böyle işi ahahahahah
      swal.fire({
        title: "emin misiniz",
        text: "son kararın mı",
        type: "warning",
        showCancelButton: "true",
        cancelButtonText: "İptal",
        confirmButtonText: "Sil",
      }).then((result) => {
        if (result.value) {
          axios.delete("/users/" + id).then((response) => {
            this.fetchData();
          });
        }
      });
    },
    refreshData(item) {
      this.fetchData();
    },
  },
};
</script>
<style>
</style>