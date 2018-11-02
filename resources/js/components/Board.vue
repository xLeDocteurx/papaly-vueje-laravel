<template>
    <div>

            <div>
                <b-button variant="outline-primary" @click="show_category_panel">New Category</b-button>
            </div>
            <div v-if="category_panel">
                <b-input-group class="col-5 mx-auto">
                    <b-form-input @keydown.enter="add_category()" v-model="category_name" type="text" class="form-control" placeholder="Enter your new category name"></b-form-input>
                    <b-input-group-append>
                    <b-button variant="outline-primary" @click="add_category()">Add new category</b-button>
                    </b-input-group-append>
                </b-input-group>
            </div>

        <div class="row px-3">
            <Category v-for="category in board.categories" :key="category.id" :thisCategory="category" :links="board.links" @del_category="delete_category(category.id)"/>
        </div>

    </div>   
</template>

<script>
// import boards from '../json/boards.json'

import Category from './Category.vue'

    export default {
        name: 'Board',
        components: {
            Category
        },
        props: {
            
        },
        data() {
            return {
                category_panel: false,
                category_name: '',
                board_id: 1,
                category_ids: [],
                board: {
                    categories: [],
                    links: []
                },
            }
        },
        created(){
            this.get_board()
        },
        methods: {
            show_category_panel(){
                this.category_panel = !this.category_panel
            },
            change_board(id){
                this.board_id = id
                this.get_board()
            },
            get_board(){
                let id = this.board_id
                window.axios.get(`api/categories/get`, {id})
                .then(response => this.board.categories = response.data.categories, e => console.log(e) )
                .then( () => this.board.categories.map( x => this.category_ids.push(x.id)), e => console.log(e))
                .then( () => {
                
                    let ids = this.category_ids
                    window.axios.post('api/links/index', {ids})
                    .then(response => this.board.links = response.data.links)
                })
            },
            add_category() {

                let data = {
                    'title': this.category_name,
                    'board_id': this.board_id
                }
                console.log(data)
                // ajax call to the api route
                window.axios.post('api/categories/store', {data})
                .then(response => {
                    this.board.categories = response.data.categories;
                });
                // On remet les inputs à zéro
                this.category_name = ''
                this.category_panel = false
            },
    		delete_category(id) {

                console.log('category to delete')
                console.log(id)

       			window.axios.post('api/categories/destroy', {id})
                .then( response => {
                    this.board.categories = this.board.categories.filter( x => x.id != id) 
                })
                .catch(e=> console.log(e.response));
    		}
        }
    }

</script>


<style>

</style>