<template>
  <div>
    <div class="list">
      <article v-for="(item, index) in items" :key="'pokemon' + index">
        <div class="icons">
          <a href="#">
            <b-icon
              class="icon"
              :value="item.name"
              icon="heart"
              @click="getFavoritePokemon(item.name)"
            ></b-icon
          ></a>
          <a href="#">
            <b-icon
              :value="item.name"
              icon="star"
              @click="getLikedPokemon(item.name)"
            ></b-icon
          ></a>
          <a href="#">
            <b-icon
              :value="item.name"
              icon="hand-thumbs-down"
              @click="getHatedPokemon(item.name)"
            ></b-icon
          ></a>
        </div>

        <img :src="imgurl + item.id + '.png'" width="100" height="100" alt="" />
        <h3>{{ item.name }}</h3>
      </article>
    </div>
    <div class="right-container">
      <div>
        <h4>Favorite Pokemon</h4>
        <h3>{{ favorite_pokemon }}</h3>
      </div>
      <div class="actions">
        <h4>Liked Pokemon</h4>
        <ul v-for="(liked, index) in liked_pokemon" :key="'liked' + index">
          <li>{{ liked }}</li>
        </ul>
      </div>
      <div class="actions">
        <h4>Hated Pokemon</h4>
        <ul v-for="(hated, index) in hated_pokemon" :key="'liked' + index">
          <li>{{ hated }}</li>
        </ul>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ["imgurl"],

  data() {
    return {
      items: [],
      nextItem: "",
      url: "",
      liked_pokemon: [],
      hated_pokemon: [],
      favorite_pokemon: "",
    };
  },

  created() {
    this.getItems();
  },

  methods: {
    getItems() {
      axios.get("http://127.0.0.1:8000/api/pokemon_item").then((resp) => {
        this.url = resp.next;
        resp.data.results.forEach((element) => {
          element.id = element.url
            .split("/")
            .filter(function (part) {
              return !!part;
            })
            .pop();
          this.items.push(element);
        });
      });
    },
    getFavoritePokemon(item) {
      this.favorite_pokemon = item;
    },
    getLikedPokemon(item) {
      let bool = false;
      this.liked_pokemon.forEach((el) => {
        if (el === item) {
          bool = true;
        }
      });
      if (bool === true) {
        alert("You already liked this pokemon");
      } else {
        if (this.liked_pokemon.length > 2) {
          this.liked_pokemon.splice(0, 1);
          this.liked_pokemon.push(item);
        } else {
          this.liked_pokemon.push(item);
        }
      }
    },
    getHatedPokemon(item) {
      let bool = false;
      this.hated_pokemon.forEach((el) => {
        if (el === item) {
          bool = true;
        }
      });
      if (bool === true) {
        alert("You already hated this pokemon");
      } else {
        if (this.hated_pokemon.length > 2) {
          this.hated_pokemon.splice(0, 1);
          this.hated_pokemon.push(item);
        } else {
          this.hated_pokemon.push(item);
        }
      }
    },
  },
};
</script>
<style scoped>
.list {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
  grid-gap: 10px;
  width: 100%;
  max-width: 600px;
  float: left;
  margin-left: 0;
}

.right-container {
  float: right;
  margin-right: 0;
}

article {
  margin-left: 0;
  margin-top: 20px;
  padding-right: 0;
  padding-top: 10px;
  width: 180px;
  height: 180px;
  background-color: white;
  text-align: center;
  text-transform: capitalize;
  border-radius: 5px;
  cursor: pointer;
  box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2), 0 10px 10px rgba(0, 0, 0, 0.2);
}

h3 {
  margin-top: 5px;
}

.icons {
  margin-top: 0;
  visibility: hidden;
}
.icon {
  margin-left: -100px;
}
article:hover .icons {
  visibility: inherit;
}

article:hover {
  background-color: aquamarine;
}
.actions {
  margin-top: 150px;
}
</style>