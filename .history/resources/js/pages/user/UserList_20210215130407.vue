<template>
  <div>
    <button @click="fetchData" class="btn btn-success float-right">Yenile</button>
    <h1>Kullanıcılar</h1>
    <div v-if="error" class="alert alert-danger">
      {{ error }}
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
        </tr>
      </thead>
      <tbody>
        <tr v-for="(item, index) in list" :key="index">
          <td scope="row">{{ index }}</td>
          <td>{{ item.name }}</td>
          <td>{{ item.email }}</td>
        </tr>
      </tbody>
    </table>
    <p v-else>Kayıt Bulunamadı</p>
  </div>
</template>

<script>
export default {
  data() {
    return {
      list: null,
      error: null,
    };
  },
  created() {
    this.fetchData();
  },
  methods: {
    fetchData() {
      axios
        .get("http://127.0.0.1:8000/api/users")
        .then((res) => {
          this.list = res.users;
          this.error = "";
        })
        .catch((error) => {
          this.error = error.response.data.message;
          
          this.list = [];
        });
    },
  },
};
</script>

<style>
</style>