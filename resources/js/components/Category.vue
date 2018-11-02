<template>
        <div class="col-sm-6 col-md-4 col-lg-3 mb-3">
            <div class="card">
                <div class="card-header">
                    <span>{{ thisCategory.title }}</span>
                    <b-btn size="sm" variant="outline-primary" @click="add_panel = !add_panel">
                        <i class="fas fa-plus"></i>
                    </b-btn>
                    <b-btn size="sm" variant="outline-danger" @click="del_category(thisCategory)">
                        <i class="far fa-trash-alt"></i>
                    </b-btn>
                </div>
                <!-- Composant permettant le rajout de lien dans la présente catégorie -->
                <div v-if="add_panel" class="list-group list-group-flush">
                    <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                        <!--<div class="input-group-addon">@</div>-->
                        <!--<input v-model="link_name" type="text" class="form-control" placeholder="Enter you link name"/>-->
                        <input v-model="link_url" type="text" class="form-control" placeholder="Enter you link address" @pkeydown.enter="add_link(link_url)"/>
                        <b-button variant="outline-success sm" @click="add_link(link_url)">Add link</b-button>
                    </div>
                </div>

                <ul class="list-group list-group-flush">
                    <!-- <li v-for="link in get_links()" @delete="del_link" :key="link.id" class="list-group-item">
                        <a :href="link.href" target="_blank">{{ link.name }}</a>
                        <button @click="delete_link(link)" class="btn btn-outline-danger btn-sm">x</button>
                    </li> -->
                    <Link v-for="link in get_links()" :key="link.id" :link="link" @delete_link="del_link(link.id)"/>
                </ul>
            </div>
        </div>

</template>

<script>
    import Link from './Link.vue'

    export default {
        name: 'Category',
        props: {
            thisCategory: Object,
            links: Array,
        },
        components: {
            Link
        },
        data() {
            return {
                add_panel: false,
                link_url: '',
                link_name: '',
            }
        },
        methods: {
            get_links(){
                return this.links.filter(link => ( link.category_id === this.thisCategory.id ))
            },
            add_link(url){
                if (Algorithmia) {
                    let input = [url,"weka"];
                    Algorithmia.client("sim5/PqeqGjLoEkEtEkK6/NfGaT1")
                        .algo("web/AnalyzeURL/0.2.17")
                        .pipe(input)
                        .then(function(output) {
                            console.log(output);
                            console.log(output.title);
                            let link = {
                                'name' : output.title,
                                'url' : this.link_url,
                                'category_id' : this.thisCategory.id
                            }
                            window.axios.post('api/links/store', {link})
                            .then( response => {
                                this.links = response.data.links
                            })
                            .catch(e => {
                                console.log(e)
                            });
                        });
                } else {
                    this.links.push({'name':this.link_url, 'url': this.link_url, 'category_id': this.thisCategory.id})
                }


                // this.links.push({
                //     // petit algo pour incrémenter les id à la manière de mysql
                //     // ---> Récupère l'id de la dernière entrée du la liste et incrémente de 1
                //     id: this.links[this.links.length - 1].id + 1,
                //     category_id: this.thisCategory.id,
                //     name:this.link_url,
                //     href:this.link_url,
                //     icon:'',
                // })
                // Nous effaçons cette variable pour remettre l'input à vide et repartir du bon pied pour une nouvelle entrée
                this.link_url = ''
                this.add_panel = false
            
            },
            del_link(id){

       			window.axios.post('api/links/destroy', {id})
                .then( response => {
                    this.links = this.links.filter(link => link.id !== id)
                })
                .catch(e=> console.log(e.response));
                
            },
            del_category(category){
                this.$emit('del_category', category)
            }
        }
    }

</script>


<style>

</style>