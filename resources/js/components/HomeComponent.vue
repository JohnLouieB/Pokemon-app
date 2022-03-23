<template>
  <div>
    <div>
      <button class="btn btn-danger" @click.prevent="logout">Logout</button>
      <button hidden class="btn btn-primary" @click.prevent="editProfile">
        Edit Profile
      </button>
      <edit-profile></edit-profile>
    </div>
    <pokemon-list :imgurl="imgurl" />
  </div>
</template>

<script>
import PokemonList from "./PokemonList.vue";
import editUser from "./modals/EditUserModal.vue";
export default {
  data() {
    return {
      imgurl:
        "https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/",
    };
  },
  mounted() {
    console.log("Component mounted.");
  },

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
    "edit-profile": editUser,
    "pokemon-list": PokemonList,
  },
};
</script>
