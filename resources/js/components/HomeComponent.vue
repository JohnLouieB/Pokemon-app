<template>
  <div>
    <div>
      <nav-bar></nav-bar>
    </div>
    <pokemon-list :imgurl="imgurl" />
  </div>
</template>

<script>
import PokemonList from "./PokemonList.vue";
import editUser from "./modals/EditUserModal.vue";
import NavBar from "./Navbar.vue";
export default {
  data() {
    return {
      imgurl:
        "https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/",
    };
  },
  beforeCreate: function () {
    document.body.className = "home";
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
    "nav-bar": NavBar,
  },
};
</script>
