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
      this.tasks[index].doneTask = !this.tasks[index].doneTask;
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
  <div class="container p-3">
    <h1 class="text-center">Todo List</h1>

    <!-- OUTPUT TASK -->
    <div class="taskContainer">
      <ul>
        <!-- Task element -->
        <li class="task" v-for="(task, idx) in tasks" :key="idx" :class="(task.doneTask === true) ? 'doneTask' : ''"
          @click.prevent="doneUndone(idx)">

          <!-- Task text (from input) -->
          <span>{{ task.text }}</span>

          <!-- "x" delete button -->
          <button @click="deleteTask(idx)">
            <i class="fa-solid fa-xmark"></i>
          </button>

        </li>

        <!-- Empty task list message (hidden) -->
        <h2 v-if="tasks.length === 0" class="emptyTasks">Non ci sono task al momento...</h2>
      </ul>
    </div>

    <form @submit.prevent="onSubmit" class="input-group mb-3">
      <input type="text" class="form-control" placeholder="Inserisci elemento..." aria-label="Recipient's username"
        aria-describedby="button-addon2" v-model="newTask.text">
      <button class="btn btn-outline-secondary" type="submit" id="button-addon2"
        @keyup.enter="onSubmit">Inserisci</button>
    </form>


  </div>
</template>

<style lang="scss">
@use './styles/general.scss';
</style>
