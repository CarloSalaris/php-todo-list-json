<script>
import axios from 'axios';
export default {
  data() {
    return {
      listElements: [],
      newTask: {
        content: ""
      }
    }
  },
  methods: {
    onSubmit() {

      const url = 'http://localhost/PHP_PROJECTS/php-todo-list-json/php/postTask.php'
      const data = this.newTask;
      const headers = {
        headers: { 'Content-Type': 'multipart/form-data' }
      };

      axios.post(url, data, headers)
        .then(response => {
          this.listElements = response.data;

          this.newTask.content = "";
        })
        .catch(error => console.error("error", error));
    }
  },
  mounted() {

    axios.get('http://localhost/PHP_PROJECTS/php-todo-list-json/php/index.php')
      .then(response => {
        this.listElements = response.data;
      });
  }
}
</script>

<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-6">
        <h1 class="text-center">Todo List</h1>
        <!-- List -->
        <div>
          <ul>
            <li v-for="(element, idx) in listElements" :key="idx">
              {{ element.content }}
            </li>
          </ul>
          <form @submit.prevent="onSubmit" class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Inserisci elemento..." aria-label="Recipient's username"
              aria-describedby="button-addon2" v-model="newTask.content">
            <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Inserisci</button>
          </form>

        </div>
      </div>
    </div>
  </div>
</template>

<style lang="scss">
@use './styles/general.scss';
</style>
