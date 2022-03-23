<template>
  <b-modal id="edit-profile">
    <input type="text" :placeholder="user.first_name" />
    <input type="text" :placeholder="user.last_name" />
    <input type="date" :placeholder="user.date_of_birth" />
    <input type="email" :placeholder="user.email" />
  </b-modal>
</template>

<script>
export default {
  data() {
    return {
      user: [],
    };
  },
  mounted() {
    axios.get("http://127.0.0.1:8000/api/user").then((res) => {
      this.user = res.data;
    });
    console.log(this.user);
  },
};
</script>
