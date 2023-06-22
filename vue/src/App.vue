<script>
import axios from 'axios';
export default {
  data() {
    return {
      listElements: [],
    }
  },
  methods: {},
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
        </div>
      </div>
    </div>
  </div>
</template>

<style lang="scss">
@use './styles/general.scss';
</style>
