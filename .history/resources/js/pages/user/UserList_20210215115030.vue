<template>
  <div>
    <h1>Kullanıcılar</h1>
    <table class="table table-bordered table-hover">
      <thead class="thead-inverse">
        <tr>
          <th>Id</th>
          <th>İsim</th>
          <th>Email</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for=""></tr>
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