<template>
  <div>
    <h1>Kullanıcılar</h1>
    <table class="table table-bordered table-hover" v-if="list!=null && list.length>0">
      <thead class="thead-inverse">
        <tr>
          <th>Id</th>
          <th>İsim</th>
          <th>Email</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="item in list" :key="item.id">
          <td scope="row">{{item.id}}</td>
          <td>{{item.name}}</td>
          <td>{{item.email}</td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
export default {
  data() {
    return {
      list: null,
    };
  },
  methods: {
    fetchData() {
      this.list = [
        {
          id: 1,
          name: "Berat",
          email: "doqtor9101@gmail.com",
        },
      ];
    },
  },
};
</script>

<style>
</style>