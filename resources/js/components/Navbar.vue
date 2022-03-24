<template>
  <div class="navbar">
    <b-navbar class="nav" toggleable="lg" type="dark">
      <b-navbar-brand href="#">Pokemon Application</b-navbar-brand>
      <div class="logout">
        <button class="logout btn btn-danger" @click.prevent="logout">
          Logout
        </button>
      </div>
      <div>
        <button hidden class="btn btn-primary" @click.prevent="editProfile">
          Edit Profile
        </button>
        <edit-user></edit-user>
      </div>
    </b-navbar>
  </div>
</template>
<script>
import editUser from "./modals/EditUserModal.vue";
export default {
  data() {},

  methods: {
    logout() {
      axios
        .post("/logout")
        .then((response) => {
          if (response.status === 302 || 401) {
            document.location.href = "/login";
          }
        })
        .catch((error) => {});
    },
    editProfile() {
      this.$root.$emit("bv::show::modal", "edit-profile");
    },
  },
  components: {
    "edit-user": editUser,
  },
};
</script>

<style scoped>
.navbar {
  width: 100%;
  margin: 0 !important;
  margin-top: -5px !important;
}
.nav {
  background-color: #0d98ba;
}
.logout {
  float: left;
  margin-right: 5px;
}
</style>