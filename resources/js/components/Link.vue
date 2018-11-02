<template>
    <li class="list-group-item">
        <span><a :href="link.url" target="_blank">{{ link.name }}</a></span>
        <!-- <button @click="" class="btn btn-outline-warning btn-sm">
            <i class="far fa-edit"></i>
        </button> -->
        <button @click="delete_link(link)" class="btn btn-outline-danger btn-sm">
            <i class="far fa-trash-alt"></i>
        </button>
    </li>
</template>

<script>
    
    export default {
        name:'Link',
        props:{
            link: Object
        },
        data() {
            return {

            }
        },
        methods:{
            delete_link(link){
                this.$emit('delete_link', link)
            }
        }
    }
</script>

<style>

</style>