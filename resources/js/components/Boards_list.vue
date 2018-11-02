<template>
	<div>
		<div>
	      	<b-button variant="outline-primary" @click="show_new_board_panel()">New Board</b-button>
	      	<b-button variant="outline-success sm" @click="show_edit_board_panel()">Edit active tab</b-button>

			<div v-if="board_panel">
		      	<b-input-group class="col-5 mx-auto">
		        	<b-form-input @keydown.enter="add_board()" v-model="board_name" type="text" class="form-control" placeholder="Enter your new board name"></b-form-input>
		        	<b-input-group-append>
		        		<b-button variant="outline-primary" @click="add_board()">Add new board</b-button>
		        	</b-input-group-append>
		      	</b-input-group>
		    </div>


		    <div v-if="edit_board_panel">
		      	<b-input-group class="col-5 mx-auto">
		        <b-form-input v-model="new_board_name" type="text" class="form-control" :value="board_name_to_edit"></b-form-input>
		        <b-input-group-append>
		        	<b-button variant="warning sm" @click="update_board()">Update Board Name</b-button>
	   	      		<b-button variant="danger sm" @click="destroy_board()">Delete Board</b-button>
		        </b-input-group-append>
		      </b-input-group>
		    </div>
	    </div>
		<div>
			<!-- if some boards are retrieved with created(), boards variable will be set to true -->
			<div v-if="boards">
				<h2>Available boards :</h2>
				<b-tabs>
					<b-tab v-for="board in boards_list" v-bind:key="board.id" :title="board.name"></b-tab>
				</b-tabs>
			</div>
			<!-- else, it means that no boards were retrieved from the database -->
			<div v-else>
				<h2>No board available yet</h2>
			</div>
		</div>
	</div>
</template>


<script>
	export default {
		name: 'Boardslist',
		props: {

		},
		data() {
			return {
				// variable to display edit_board_panel when set to true
				edit_board_panel: false,
				// variable filled with active tab name when clicking on "Edit active tab" button
				board_name_to_edit: '',
				// variable filled with new board name for update_board function
				new_board_name: '',
				// variable to display new board panel when set to true
				board_panel: false,
      			board_name: '',
				boards: false,
				boards_list: []
			}
		},
		methods: {
			show_new_board_panel()	{
      			return this.board_panel = !this.board_panel;
    		},
    		show_edit_board_panel() {
    			if (this.edit_board_panel == false) {
    				this.board_name_to_edit = this.new_board_name;
    				let active_tab = document.querySelectorAll('a.active');
    				let active_tab_name = active_tab[0].innerHTML;
    				this.board_name_to_edit = active_tab_name;
    			}
    			return this.edit_board_panel = !this.edit_board_panel;
    		},
    		update_board(){
    			let old_name = this.board_name_to_edit;
    			let new_name = this.new_board_name;
	   			let id;
    			// map through boards_list to get id of the selected board
    			this.boards_list.map( x => {
    				if(x.name == old_name ){
    					return id = x.id;
    				}
    			});
    			let data = {
    				'name' : new_name,
    				'id' : id
    			}
    			console.log(data);
    			window.axios.post('api/boards/update', {data})
    			.then(response => console.log(response.data.message))
    			.then(() => this.boards_list.map( x => {
    				if (x.id == id) {
    					return x.name = new_name;
    				}
    			}));
    		},
    		destroy_board() {
    			let name = this.board_name_to_edit;
    			let id;
    			// map through boards_list to get id of the selected board
    			this.boards_list.map( x => {
    				if(x.name == name ){
    					return id = x.id;
    				}
    			});
    			// send post request to api route with the board's id
       			window.axios.post('api/boards/destroy', {id})
       			.then(response => console.log(response.data.message))
       			.then( () => this.boards_list = this.boards_list.filter( x => x.id != id) );
    		},
			add_board() {
      			let name = this.board_name;
      			let data = {
        			'name': name,
        			'user_id': thisUser 
      			}
      			// ajax call to the api route
      			window.axios.post('api/boards/store', {data})
      			.then(response => this.boards_list.push(response.data.new_board));
                this.board_name = ''
                this.board_panel = false
    		}
		},
		// fetch existing boards with ajax
		created() {
			window.axios.get('api/boards/index')
			.then( (response) => {
				// when a response is handled, set boards variable to true to display them and push all results in boards_list
				this.boards = true;
				this.boards_list = response.data;
			});
		}
	}
</script>