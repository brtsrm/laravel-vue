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
        <tr>
          <td scope="row">1</td>
          <td>Berat</td>
          <td>doqtor9101@gmail.com</td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
export default {
  data() {
    return {
      list: null;
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
        ]
    },
  },
};
</script>

<style>
</style>