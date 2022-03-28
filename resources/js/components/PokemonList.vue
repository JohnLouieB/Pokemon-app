<template>
  <div>
    <div class="list">
      <article v-for="(item, index) in items" :key="'pokemon' + index">
        <div class="icons">
          <a href="#/">
            <b-icon
              class="icon"
              :value="item.name"
              aria-label="Favorite"
              title="Favorite"
              icon="heart"
              @click="getFavoritePokemon(item.name)"
            ></b-icon
          ></a>
          <a href="#/">
            <b-icon
              :value="item.name"
              icon="star"
              aria-label="Like"
              title="Like"
              @click="getLikedPokemon(item.name)"
            ></b-icon
          ></a>
          <a href="#/">
            <b-icon
              :value="item.name"
              aria-label="Hate"
              title="Hate"
              icon="hand-thumbs-down"
              @click="getHatedPokemon(item.name)"
            ></b-icon
          ></a>
        </div>

        <img :src="imgurl + item.id + '.png'" width="60" height="60" alt="" />
        <h6>{{ item.name }}</h6>
      </article>
    </div>
    <div class="right-container">
      <div class="buttons">
        <b-button variant="success" @click.prevent="getMoreItems"
          >next</b-button
        >
        <b-button variant="primary" @click.prevent="getPrevItems"
          >previous</b-button
        >
      </div>
      <div>
        <h4>Favorite Pokemon</h4>
        <h3>{{ favorite_pokemon }}</h3>
      </div>
      <div class="actions">
        <h4>Liked Pokemon</h4>
        <div v-for="(liked, index) in liked_pokemon" :key="'liked' + index">
          <p>{{ liked }}</p>
        </div>
      </div>
      <div class="actions">
        <h4>Hated Pokemon</h4>
        <div v-for="(hated, index) in hated_pokemon" :key="'liked' + index">
          <p>{{ hated }}</p>
        </div>
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
      nxturl: "",
      liked_pokemon: [],
      hated_pokemon: [],
      favorite_pokemon: "",
      prevurl: "",
    };
  },

  created() {
    this.getItems();
  },

  mounted() {
    this.getMoreItems();
  },

  methods: {
    getItems() {
      axios.get("http://localhost:8000/api/pokemon_item").then((resp) => {
        this.nxturl = resp.data.next;
        this.count = resp.data.count;
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
    getMoreItems() {
      axios.get(this.nxturl).then((resp) => {
        this.nxturl = resp.data.next;
        this.prevurl = resp.data.previous;
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
    getPrevItems() {
      axios.get(this.prevurl).then((resp) => {
        this.nxturl = resp.data.next;
        this.prevurl = resp.data.previous;
        this.items = [];
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

    next() {
      this.url;
      this.getItems();
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
.buttons {
  margin-top: 5px;
  margin-bottom: 5px;
  float: left;
  margin-left: 5px;
}
.list {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
  grid-gap: 10px;
  width: 100%;
  max-width: 600px;
  float: left;
  margin-left: 15%;
  margin-bottom: 5%;
  margin-top: 20px;
}

.infinitescroll {
  height: 150px;
  width: 100%;
  font-size: 2rem;
  display: flex;
  justify-content: center;
  align-items: center;
  color: white;
}

body {
  background-color: aquamarine !important;
}

.right-container {
  float: right;
  margin-left: 50%;
  width: 40%;
  height: 600px;
  max-height: 800px;
  margin-top: 1%;
  margin-right: 0;
  background-color: white;
  border-radius: 5px;
  background-repeat: no-repeat;
  justify-content: space-between;
  box-shadow: 0 0 20px 6px #090b6f85;
  text-align: center;
  position: fixed;
}

article {
  margin-left: 0;
  padding-right: 0;
  padding-top: 10px;
  width: 180px;
  height: 120px;
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

h4 {
  /* background-color: aqua; */
  margin-top: 50px;
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
  margin-top: 100px;
}
</style>