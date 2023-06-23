<script>
import axios from 'axios';
export default {
  data() {
    return {
      tasks: [],
      newTask: {
        text: "",
        doneTask: false
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
        .then(res => {
          this.tasks = res.data;

          this.newTask.text = "";
          this.newTask.doneTask = false;

          console.log(this.tasks);

        })
        .catch(error => console.error("error", error));
    },

    doneUndone(index) {

      const url = 'http://localhost/PHP_PROJECTS/php-todo-list-json/php/selectTask.php';
      const data = { "index": index };
      const headers = {
        headers: { 'Content-Type': 'multipart/form-data' }
      };

      axios.post(url, data, headers)
        .then(res => {
          this.tasks = res.data;
          console.log(this.tasks);
        })
    },

    deleteTask(index) {

      const url = 'http://localhost/PHP_PROJECTS/php-todo-list-json/php/deleteTask.php';
      const data = { "index": index };
      const headers = {
        headers: { 'Content-Type': 'multipart/form-data' }
      };

      axios.post(url, data, headers)
        .then(res => {
          this.tasks = res.data;
          console.log(this.tasks);
        })
    }
  },
  mounted() {

    axios.get('http://localhost/PHP_PROJECTS/php-todo-list-json/php/index.php')
      .then(res => {
        this.tasks = res.data;
        console.log(res.data);
      });
  }
}
</script>

<template>
  <div class="wrap">

    <div class="container p-3">
      <div class="row justify-content-center">
        <div class="col-lg-6 col-xl-4">

          <!-- TITOLO -->
          <h1 class="text-center display-1 text-light-emphasis">Todo List</h1>

          <!-- LISTA -->
          <ul>
            <!-- Task element (in v-for) -->
            <li class="task" v-for="(task, idx) in tasks" :key="idx">

              <!-- Task text (from input) -->
              <span @click.prevent="doneUndone(idx)" :class="(task.doneTask == 'true') ? 'doneTask' : ''">
                {{ task.text }}
              </span>

              <!-- Delete button -->
              <button @click="deleteTask(idx)" type="button" class="my-2 btn btn-danger">
                <i class="fa-solid fa-trash"></i>
              </button>
            </li>

            <!-- HIDDEN MESSAGE -->
            <!-- Empty task list message (hidden) -->
            <h2 v-if="tasks.length === 0" class="emptyTasks">Non ci sono task al momento...</h2>

          </ul>

          <!-- INPUT -->
          <form @submit.prevent="onSubmit" class="input-group mb-3 px-0">
            <input type="text" class="form-control  py-2" placeholder="Inserisci elemento..."
              aria-label="Recipient's username" aria-describedby="button-addon2" v-model="newTask.text">
            <button @keyup.enter="onSubmit" class="btn btn-outline-warning py" type="submit" id="button-addon2">
              Inserisci
            </button>
          </form>
        </div>
      </div>

    </div>
  </div>
</template>

<style lang="scss">
@use './styles/general.scss';

.wrap {
  width: 100vw;
  height: 100vh;
  background-color: #001632;
}
</style>
