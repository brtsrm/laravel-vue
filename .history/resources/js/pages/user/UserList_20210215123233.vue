<template>
  <div>
    <h1>Kullanıcılar</h1>
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
          this.list = res.data;
        })
        .catch((error) => {
          this.error = error;
        });
        console.log(this.error);
    },
  },
};
</script>

<style>
</style>