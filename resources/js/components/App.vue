
<template>

  <div id="app">
    
    <Boardslist/>
    <!--<Navbar title="Simple Navbar"/>-->
    <Board/>
    
  </div>
  
</template>

<script>
import Vue from 'vue'
import BootstrapVue from 'bootstrap-vue'
Vue.use(BootstrapVue);
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

import Boardslist from './Boards_list.vue'
import Navbar from './Navbar.vue'
import Board from './Board.vue'



export default {
  name: 'app',
  components: {
    Navbar,
    Board,
    Boardslist,
  },
  data(){
    return {
      
    }
  }
}
</script>

<style>
  
</style>
